<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Room;

class RoomController extends Controller
{
    public function index()
    {
        return view('rooms.index');
    }


    public function create()
    {
        return view('rooms.create');
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100|unique:rooms,type_name',
            'description' => 'nullable|string',
            'price' => 'required|integer|min:0',
            'capacity' => 'required|integer|min:1',
            'total_rooms' => 'required|integer|min:1',
        ]);

        $dataToStore = [
            'type_name'   => $validated['name'],
            'description' => $validated['description'],
            'price'       => $validated['price'],
            'capacity'    => $validated['capacity'],
            'total_rooms' => $validated['total_rooms'],
        ];

        $room = Room::create($dataToStore);

        // 画像URLの処理 (今回はスキップ)
        /*
        // 補足: 将来的に画像を保存する場合のイメージ
        if ($request->filled('image_url')) {
            // room_imagesテーブルへの保存処理はここで行う
            // 例: $room->images()->create(['url' => $request->input('image_url')]);
        }
        */

        return redirect()->route('rooms.index')->with('success', $room->type_name . ' が正常に登録されました。');
    }

    public function show(Room $room)
    {
        //
    }


    public function edit(Room $room)
    {
        //
    }


    public function update(Request $request, Room $room)
    {
        //
    }


    public function destroy(Room $room)
    {
        //
    }
}
