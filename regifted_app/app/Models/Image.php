<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Image extends Model
{
    use HasFactory;
    protected $fillable = [
        'url',
        'imageable_id',
        'imageable_type'
    ];
    protected $hidden=[
        'imageable_type',
    ];

    public function imageable(): MorphTo
    {
        return $this->morphTo();
    }
    public function user():BelongsTo{
        return $this->belongsTo(User::class);
    }

    public function item():BelongsTo{
        return $this->belongsTo(Item::class);
    }
}
