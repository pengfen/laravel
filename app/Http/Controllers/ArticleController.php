<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Article;
use \App\Comment;
use \App\Zan;

class ArticleController extends Controller
{
    // 文章列表页
    public function index()
    {
        // $articles = Article::orderBy('created_at', 'desc')->get();
        // $articles = Article::orderBy('created_at', 'desc')->withCount('comments')->paginate(6);
        $articles = Article::orderBy('created_at', 'desc')->withCount(['comments', 'zans'])->paginate(6);
        return view("article/index", compact('articles'));
    }

    // 文章详情页
    public function detail(Article $article)
    {
        $article->load('comments'); // 预加载
        return view('article/detail', compact('article'));
    }

    // 添加
    public function create()
    {
        return view('article/create');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store()
    {
        // 验证数据
        $this->validate(request(), [
            'title' => 'required|string|max:100|min:5',
            'content' => 'required|string|min:10',
        ]);

        // 添加
        $user_id = \Auth::id();
//        $params = array_merge(request(['title', 'content']), compact('user_id'));
//        Article::create($params);
        $article = new Article();
        $article->title = \request('title');
        $article->content = \request('content');
        $article->user_id = $user_id;
        $article->save();
        //Article::create(request(['title', 'content']));

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
        $this->authorize('update', $article);

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
        $this->authorize('delete', $article);

        $article->delete();

        return redirect('/articles');
    }

    public function test()
    {
        return;
    }

    // 提交评论
    public function comment(Article $article)
    {
        $this->validate(request(), [
            'content' => 'required|min:3',
        ]);

        //
        $comment = new Comment();
        $comment->user_id = \Auth::id();
        $comment->content = request('content');
        $article->comments()->save($comment);

        //
        return back();
    }

    // 赞
    public function zan(Article $article)
    {
        $param = [
            'user_id' => \Auth::id(),
            'article_id' => $article->id,
        ];

        // Zan::firstOrCreate($param);
        $zan = new Zan();
        $zan->user_id = \Auth::id();
        $zan->article_id = $article->id;
        $zan->save();
        return back();
    }

    // 取消赞
    public function unzan(Article $article)
    {
        $article->zan(\Auth::id())->delete();
        return back();
    }
}
