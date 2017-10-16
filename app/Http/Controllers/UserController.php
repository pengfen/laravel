<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    /*
     * 个人介绍页面
     */
    public function show(User $user)
    {
        // 这个人的文章
        $articles = $user->articles()->orderBy('created_at', 'desc')->take(10)->get();
        // 这个人的关注／粉丝／文章
        $user = \App\User::withCount(['stars', 'fans', '$articles'])->find($user->id);
        $fans = $user->fans()->get();
        $stars = $user->stars()->get();

        //$stars = $user->stars;
        //$susers = User::whereIn("id", $stars->pluck('star_id'))->withCount(['stars', 'fans', 'articles'])->get();

        //$fans = $user->fans;
        //$fusers = User::whereIn('id', $fans->pluck('fan_id'))->withCount(['stars', 'fans', 'articles'])->get();

        return view("user/show", compact('user', '$articles', 'fans', 'stars'));
    }

    public function fan(User $user)
    {
        $me = \Auth::user();
        \App\Fan::firstOrCreate(['fan_id' => $me->id, 'star_id' => $user->id]);
        return [
            'error' => 0,
            'msg' => ''
        ];
    }

    public function unfan(User $user)
    {
        $me = \Auth::user();
        \App\Fan::where('fan_id', $me->id)->where('star_id', $user->id)->delete();
        return [
            'error' => 0,
            'msg' => ''
        ];
    }

    public function setting()
    {
        $me = \Auth::user();
        return view('user/setting', compact('me'));
    }

    public function settingStore(Request $request, User $user)
    {
        $this->validate(request(),[
            'name' => 'min:3',
        ]);

        $name = request('name');
        if ($name != $user->name) {
            if(\App\User::where('name', $name)->count() > 0) {
                return back()->withErrors(array('message' => '用户名称已经被注册'));
            }
            $user->name = request('name');
        }
        if ($request->file('avatar')) {
            $path = $request->file('avatar')->storePublicly(md5(\Auth::id() . time()));
            $user->avatar = "/storage/". $path;
        }

        $user->save();
        return back();
    }
}
