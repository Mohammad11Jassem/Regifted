<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
        'size',
        'gender',
        'booked',
        'age',
        'description'
    ];


    public function image(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function categories(): HasMany
    {
        return $this->hasMany(Category::class, 'item_id');
    }
    public function orders():HasMany{
        return $this->hasMany(order::class,'item_id');
    }

}
