@extends('layouts.app')

@section('content')
<div class="card-body">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h5 class="card-title">検索フォーム</h5>
                <div id="custom-search-input">
                    <div class="input-group col-md-12">
                        <form action="{{ route('posts.search') }}" method="GET">
                            @csrf
                            <input type="text" class="form-control input-lg" placeholder="Buscar" name="search" value="">
                            <span class="input-group-btn" style="position: relative;top: -36px;right: -179px;">
                                <button class="btn btn-info" type="submit">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                        </span>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<div class="container">
    @isset($search_result)
        <h5 class="card-title">{{ $search_result }}</h5>
    @endisset
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Board</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
@foreach ($posts as $post)                   
<div class="card">
    <div class="card-body">
        <h5 class="card-title">{{ $post->title }}</h5>
        <p class="card-title">カテゴリー:
            <a href="{{ route('home', ['category_id' => $post->category_id]) }}">{{ $post->category->category_name }}</a>
        </p>
        <p class="card-title">Tag:
            @foreach ($post->tags as $tag)
            <a href="{{ route('home', ['tag_name' => $tag->tag_name]) }}">#{{ $tag->tag_name }}</a>
            @endforeach
        </p>
        <p class="card-title">投稿者:
        <a href="{{ route('users.show', [$post->user_id]) }}">
            {{ $post->user->name }}
        </a>   
        @if($post->users()->where('user_id', Auth::id())->exists())
        <div class="col-md-3">
            <form action="{{ route('unfavorites', $post) }}" method="POST">
                @csrf
                <input type="submit" value="&#xf164;いいね取り消す" class="fas btn btn-danger">
            </form> 
        </div>
        @else
        <div class="col-md-3">
        <form action="{{ route('favorites', $post) }}" method="POST">
            @csrf
            <input type="submit" value="&#xf164;いいね" class="fas btn btn-success">
        </form>
        </div>
        @endif
        <div class="row justify-content-center">
            <p>いいね数：{{ $post->users()->count() }}</p>
        </div>
        <a href="{{ route('show', $post->id)}}" class="btn btn-primary">詳細</a>
    </div>
</div>
@endforeach
@if(isset($q['category_id']))
    {{ $posts->appends(['category_id' => $q['category_id']])->links() }}
    
@elseif(isset($tag_name))
    {{ $posts->appends(['tag_name' => $tag_name])->links() }}

@elseif(isset($search_query))
    {{ $posts->appends(['search' => $search_query])->links() }}

@else
    {{ $posts->links() }}
@endif
</div>
            </div>
        </div>
    </div>
</div>
@endsection
