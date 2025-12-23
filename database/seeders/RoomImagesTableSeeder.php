<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RoomImage;
use App\Models\Room;

class RoomImagesTableSeeder extends Seeder
{
    public function run(): void
    {
        RoomImage::truncate();

        // --- プレミアムルーム (ID: 1) 用の画像5枚 ---
        RoomImage::create([
            'room_id'    => 1,
            'image_url'  => 'https://i.postimg.cc/mgvW8gz5/premium1.jpg',
            'sort_order' => 1,
        ]);

        RoomImage::create([
            'room_id'    => 1,
            'image_url'  => 'https://i.postimg.cc/FK05qX3W/premium2.jpg',
            'sort_order' => 2,
        ]);

        RoomImage::create([
            'room_id'    => 1,
            'image_url'  => 'https://i.postimg.cc/hGVWwRTZ/premium3.jpg',
            'sort_order' => 3,
        ]);

        RoomImage::create([
            'room_id'    => 1,
            'image_url'  => 'https://i.postimg.cc/SKcF5bCP/premium4.jpg',
            'sort_order' => 4,
        ]);

        RoomImage::create([
            'room_id'    => 1,
            'image_url'  => 'https://i.postimg.cc/cJfyjGwb/premium5.jpg',
            'sort_order' => 5,
        ]);

        // --- スタンダードルーム (ID: 2) 用の画像5枚 ---
        RoomImage::create([
            'room_id'    => 2,
            'image_url'  => 'https://i.postimg.cc/5t8dGW8c/standard1.jpg',
            'sort_order' => 1,
        ]);

        RoomImage::create([
            'room_id'    => 2,
            'image_url'  => 'https://i.postimg.cc/hGVWwRTk/standard2.jpg',
            'sort_order' => 2,
        ]);

        RoomImage::create([
            'room_id'    => 2,
            'image_url'  => 'https://i.postimg.cc/Pq1scn1T/standard3.jpg',
            'sort_order' => 3,
        ]);

        RoomImage::create([
            'room_id'    => 2,
            'image_url'  => 'https://i.postimg.cc/3w256Q2J/standard4.jpg',
            'sort_order' => 4,
        ]);

        RoomImage::create([
            'room_id'    => 2,
            'image_url'  => 'https://i.postimg.cc/Zqs7VfMt/standard5.png',
            'sort_order' => 5,
        ]);
    }
}
