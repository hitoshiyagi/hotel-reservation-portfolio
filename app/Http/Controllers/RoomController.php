<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Room;

class RoomController extends Controller
{
    /**
     * 部屋タイプの一覧を表示する (R: Read - Index).
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // 1. データベースからすべての部屋タイプを取得
        // 最新の登録順に並べるのが一般的です
        $rooms = Room::orderBy('created_at', 'desc')->get();

        // 2. rooms/index.blade.php にデータを渡して表示
        return view('rooms.index', [
            'rooms' => $rooms
        ]);
    }


    public function create()
    {
        return view('rooms.create');
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            // type_name => 部屋タイプ名
            'type_name'   => 'required|string|max:100',
            // description => 説明
            'description' => 'required|string',
            // 料金は in ルールで厳密に120000か200000のみを許可
            'price'       => 'required|integer|in:120000,200000',
            // 定員は 1 から 4 の範囲に制限
            'capacity'    => 'required|integer|min:1|max:4',
            // 合計部屋数は 1 から 5 の範囲に制限
            'total_rooms' => 'required|integer|min:1|max:5',
        ]);

        $dataToStore = [
            'type_name'        => $validated['type_name'],
            'description' => $validated['description'],
            'price'       => $validated['price'],
            'capacity'    => $validated['capacity'],
            'total_rooms' => $validated['total_rooms'],
        ];

        $room = Room::create($dataToStore);

        return redirect()->route('rooms.index')->with('success', $room->type_name . ' が正常に登録されました。');
    }

    public function show(Room $room)
    {
        //
    }


    /**
     * 特定の部屋タイプを編集するためのフォームを表示する (U: Update - Edit).
     */
    public function edit(string $id)
    {
        // 1. 編集対象の部屋タイプをIDで取得 (見つからない場合は404)
        $room = \App\Models\Room::findOrFail($id);

        // 2. 編集ビューにデータを渡して表示
        // 💡 ファイル名: resources/views/rooms/edit.blade.php を想定
        return view('rooms.edit', compact('room'));
    }

    /**
     * フォームから送信された更新内容をデータベースに保存する (U: Update - Update).
     */
    public function update(Request $request, string $id)
    {
        // 1. 編集対象の部屋タイプを取得
        $room = \App\Models\Room::findOrFail($id);

        // 2. バリデーション (ユニーク制約の例外処理が必要)
        $validated = $request->validate([
            // 💡 unique:rooms,type_name,{ID},id の形式で、自分自身を例外として許可
            'type_name' => 'required|string|max:100|unique:rooms,type_name,' . $room->id,
            'description' => 'nullable|string',
            'price' => ['required', 'integer', 'in:120000,200000'],
            'capacity' => 'required|integer|min:1|max:4',
            'total_rooms' => 'required|integer|min:1|max:5',
            'image_url' => 'nullable|url',
        ]);

        // 3. データベースへの保存に必要なデータに整形
        $dataToUpdate = [
            'type_name'   => $validated['type_name'], // フォームの name='type_name' を使用
            'description' => $validated['description'],
            'price'       => $validated['price'],
            'capacity'    => $validated['capacity'],
            'total_rooms' => $validated['total_rooms'],
        ];

        // 4. 更新を実行
        $room->update($dataToUpdate);

        // 5. リダイレクト (一覧ページに戻る)
        return redirect()->route('rooms.index')->with('success', $room->type_name . ' の情報が正常に更新されました。');
    }




    public function destroy(Room $room)
    {
        //
    }
}

