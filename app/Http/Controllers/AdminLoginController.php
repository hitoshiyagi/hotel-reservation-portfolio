<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminLoginController extends Controller
{
    public function show()
    {
        return view('auth.adminlogin'); // ビュー名は登録と合わせてauthフォルダに
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 1. emailでユーザーを検索
        $user = User::where('email', $request->email)->first();

        // 2. ユーザーが存在しない
        if (!$user) {
            return back()->withErrors([
                'email' => 'メールアドレスまたはパスワードが正しくありません',
            ]);
        }

        // 3. パスワードの照合
        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors([
                'email' => 'メールアドレスまたはパスワードが正しくありません',
            ]);
        }

        // 4. 管理者権限チェック（role='admin'）
        if ($user->role !== 'admin') {
            return back()->withErrors([
                'email' => '管理者権限がありません',
            ]);
        }

        // 5. セッションに保存　※矢木さんのセッションキーにあわせる
        session([
            'admin_id' => $user->id,
            'admin_role' => $user->role,
            'admin_status' => $user->status,
        ]);

        $request->session()->regenerate();
        
        return redirect()->intended('/admin/dashboard'); // 管理者用ダッシュボードへ
    }
}
