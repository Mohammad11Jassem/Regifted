<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest\EditProfileRequest;
use App\Http\Requests\AuthRequest\LoginRequest;
use App\Http\Requests\AuthRequest\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\Image;
use App\Models\Location;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(RegisterRequest $request){
        $user=new User;

        $location=Location::create(['name' => $request['location']]);
        // $user->name=$request['name'];
        $user->password= Hash::make($request['password']);
        $user->phone_number=$request['phone_number'];
        $user->location_id=$location->id;
        $user->save();
        if($request->hasFile('image') &&$user){
            $image = $request->file('image');
            $image_name=time() . '.' . $image->getClientOriginalExtension();
            $image->move('ProfileImages/',$image_name);
            $user->image()->create([
                'url'=>"ProfileImages/".$image_name
            ]);
        }
        $token = $user->createToken('token')->plainTextToken;
        // return new UserResource($user);
        return response()->json([
            'token'=>$token,
            'data'=>new UserResource($user),
        ],200);
    }
    public function profile(){
        return response()->json(
            ['data'=>new UserResource(auth()->user())],200);

    }

    public function login(LoginRequest $request)
    {
        $user = User::where('phone_number',$request['phone_number'])->first();

        if(!$user || !Hash::check($request['password'],$user->password)){
            return response()->json([
                'message' =>'failed authorize'
            ],401);
        }
        if(!$user['verified']){
            return response()->json([
                'message'=>'your account not verified yet'
            ],200);
        }
        $token = $user->createToken('token')->plainTextToken;
        $user->save();
        return response()->json([
            'message'=> 'login done',
            'token' => $token,
        ],200);
    }


    public function logout(Request $request)
    {

        $request->user()->tokens()->delete();

        return response()->json([
        'message' => 'Successfully logged out'
        ],200);
    }



    public function updateProfile(EditProfileRequest $request)
    {
        $user=User::findOrFail(auth()->user()->id);
        
        $user->location()->update(['name'=>$request['location']]);
        // $user->name=$request['name'] ?? $user['name'];
        $imageUrl=$user->image->url??null;
        if($request->hasFile('image')){

            if(($imageUrl)&&File::exists($imageUrl))
            {

                File::delete($user->image->url);

            }

            $image = $request->file('image');
            $image_name=time() . '.' . $image->getClientOriginalExtension();
            $image->move('ProfileImages/',$image_name);
            $user->image()->updateOrCreate(
                ['imageable_id'=>$user->id]
            ,['url'=>"ProfileImages/".$image_name
            ]);
        }
        $user->save();

        return response()->json([
            'message'=> 'updated successfully',
            'data'=>new UserResource(auth()->user()),
        ],200);
    }
}
