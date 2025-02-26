<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'item_id'
    ];

    public function user():BelongsTo{
        return $this->belongsTo(user::class,'user_id');
    }

    public function item():BelongsTo{
        return $this->belongsTo(item::class,'item_id');
    }
}
