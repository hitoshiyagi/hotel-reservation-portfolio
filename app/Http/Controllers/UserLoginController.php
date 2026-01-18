<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserLoginController extends Controller
{
    public function show()
    {
        return view('auth.userlogin');
    }

    public function login(Request $request)
    {
        // 1. バリデーション（ここでエラーがあると入力が消えて戻ります）
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 2. ユーザーをメールアドレスで検索
        $user = User::where('email', $request->email)->first();

        // 3. ユーザーが存在し、パスワードが合致するか確認
        if ($user && Hash::check($request->password, $user->password)) {

            // 【重要】手作りセッションに保存（これが BookingController での判定に使われます）
            session(['user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
            ]]);

            // セッションIDの再生成（セキュリティ用）
            $request->session()->regenerate();

            // 成功：予約画面へ
            return redirect('/booking/create')->with('success', 'ログインしました');
        }

        // 4. 失敗：エラーメッセージを付けて戻す
        return back()->withErrors([
            'email' => 'メールアドレスまたはパスワードが正しくありません',
        ])->withInput($request->only('email')); // メールアドレスだけ入力欄に残す
    }
}
