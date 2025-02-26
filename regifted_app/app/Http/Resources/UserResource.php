<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'phone_number'=>$this->phone_number,
            'location_id'=>$this->location_id,
            'created_at'=>$this->created_at,
            'updated_at'=>$this->updated_at,
            'image'=>$this->image,
            'location'=>$this->location
        ];
    }
}
