@extends("layout.main");

@section("content")
    <div class="col-sm-8 blog-main">
        <div class="blog-post">
            <div style="display: inline-flex;">
                <h2 class="blog-post-title">{{$article->title}}</h2>
                <a style="margin: auto"  href="/articles/{{$article->id}}/edit">
                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                </a>
                <a style="margin: auto"  href="/articles/{{$article->id}}/delete">
                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                </a>
            </div>
        </div>
    </div>
@endsection