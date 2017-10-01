@extends("layout.main")

@section("content")

    <div class="alert alert-success" role="alert">
        下面是搜索"{{$query}}"出现的文章，共{{$articles->total()}}条
    </div>

    <div class="col-sm-8 blog-main">
        @foreach($articles as $article)
            <div class="blog-post">
                <h2 class="blog-post-title"><a href="/articles/{{$article->id}}" >{{$article->title}}</a></h2>
                <p class="blog-post-meta">{{$article->created_at->toFormattedDateString()}} by <a href="#">Mark</a></p>

                <p>{!! str_limit($article->content, 200, '...') !!}</p>
            </div>
        @endforeach

        {{$articles->links()}}
    </div><!-- /.blog-main -->


@endsection