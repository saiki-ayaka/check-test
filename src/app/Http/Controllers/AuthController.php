<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Models\Contact;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function index()
{
    return view('auth.login'); 
}

    public function admin(Request $request)
{
    // お問い合わせデータを取得している箇所を探してください
    $contacts = Contact::with('category')
                /* 検索処理などがあるはずです */
                ->paginate(7)      // 1ページに表示する件数
                ->onEachSide(1);   // ★ここを追加！これで表示されるページ数が絞られます

    $categories = Category::all();

    return view('admin.index', compact('contacts', 'categories'));
}

    public function store(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if(Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/admin');
        }

        return back()->withErrors([
            'password' => 'ログイン情報が登録されていません'
        ])->withInput();
    }

    public function create()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            // 【重要】Hash::make で暗号化しないとログインできません
            'password' => Hash::make($request->password),
        ]);

        return redirect('/login');
    }

    public function destroy(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
