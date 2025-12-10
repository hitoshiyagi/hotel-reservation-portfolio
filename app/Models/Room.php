<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\RoomImage;

class Room extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'type_name',
        'description',
        'price',
        'capacity',
        'total_rooms',
        // 'image_url'はroom_imagesテーブルにあるため不要
    ];

    public function images()
    {
        return $this->hasMany(\App\Models\RoomImage::class)->orderBy('sort_order');
    }

    public function getPrimaryImageUrlAttribute()
    {
        return $this->images->first()->image_url ?? '';
    }
}
