@extends("layout.main")

@section("content")
    <div class="col-sm-8 blog-main">
        <div><a href="/article/create">添加</a>  <a href="/register">注册</a> <a href="/logout">退出</a></div>
        <div style="height: 20px;">
        </div>
        <div>
            @foreach($articles as $article)
                <div class="blog-post">
                    <h2 class="blog-post-title"><a href="/articles/{{$article->id}}" >{{$article->title}}</a></h2>
                    <p class="blog-post-meta">{{$article->created_at->toFormattedDateString()}} by <a href="/user/{{$article->user_id}}">{{$article->user->name}}</a></p>

                    {!! str_limit($article->content, 100, '...') !!}
                    <p class="blog-post-meta">赞   | 评论 {{$article->comments_count}}</p>
                </div>
            @endforeach

            {{$articles->links()}}
        </div><!-- /.blog-main -->
    </div>
@endsection