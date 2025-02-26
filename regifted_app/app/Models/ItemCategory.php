<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ItemCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'item_id'
    ];

    public function category():BelongsTo{
        return $this->belongsTo(category::class,'category_id');
    }

    public function item():BelongsTo{
        return $this->belongsTo(item::class,'item_id');
    }
}
