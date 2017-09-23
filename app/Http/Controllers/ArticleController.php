<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Article;

class ArticleController extends Controller
{
    // 文章列表页
    public function index()
    {
        // $articles = Article::orderBy('created_at', 'desc')->get();
        $articles = Article::orderBy('created_at', 'desc')->paginate(6);
        return view("article/index", compact('articles'));
    }

    // 文章详情页
    public function detail(Article $article)
    {
        return view('article/detail', compact('article'));
    }

    // 添加
    public function create()
    {
        return view('article/create');
    }

    public function store()
    {
        // 验证数据
        $this->validate(request(), [
            'title' => 'required|string|max:100|min:5',
            'content' => 'required|string|min:10',
        ]);

        // 添加
        Article::create(request(['title', 'content']));

        // 渲染
        return redirect('/articles');
    }

    // 编辑
    public function edit(Article $article)
    {
        return view('article/edit', compact('article'));
    }

    public function update(Article $article)
    {
        // 验证数据
        $this->validate(request(), [
            'title' => 'required|string|max:100|min:5',
            'content' => 'required|string|min:10',
        ]);

        // 修改
        $article->title = request('title');
        $article->content = request('content');
        $article->save();

        // 渲染
        return redirect("/articles/{$article->id}");
    }

    // 删除
    public function delete(Article $article)
    {
        // 用户权限验证

        $article->delete();

        return redirect('/articles');
    }

    public function test()
    {
        return;
    }
}
