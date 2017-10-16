<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    //
    public function index()
    {
        if(\Auth::check()) {
            return redirect("/articles");
        }
        return view('login/index');
    }

    // 登录操作
    public function login()
    {
        // 验证
        $this->validate(\request(), [
            'email' => 'required|email',
            'password' => 'required|min:5|max:10',
            'is_remember' => 'integer'
        ]);

        // 逻辑
        $user = request(['email', 'password']);
        $is_member = boolval(\request('is_remember'));
        if (\Auth::attempt($user, $is_member)) {
            return redirect('/articles');
        }

        //
        return \Redirect::back();
    }

    // 退出
    public function logout()
    {
        \Auth::logout();
        return redirect('/login');
    }
}
