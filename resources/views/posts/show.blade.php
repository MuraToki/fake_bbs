@extends('layouts.app')

@section('content')
<div class="card-header">Board</div>
    <div class="card-body">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif                
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $post->title }}</h5>
            <p class="card-title">カテゴリー:{{ $post->category->id }}</p>
            <p class="card-title">投稿者:{{ $post->user->name }}</p>
            <img src="{{ asset('storage/image/'.$post->image) }}" style="height: 200px;">
            <p class="card-text">{{ $post->content}}</p>
            <form method="POST" action="{{ route('delete', $post->id)}}" onSubmit="return checkDlete()">
                @csrf

                <td><button type="submit" class="btn btn-danger" onclick=>削除</button></td>
              </form>
            <a href="{{ route('home')}}" class="btn btn-primary">BACK</a>

        </div>
    </div>
    <div class="comment">
        <h1>Comment</h1>
    </div>
    @foreach ($post->comment as $comment)
    <div class="card">
        <div class="card-body">
            <p class="card-text">{{ $comment->comment }}</p>
            <p class="card-text">
                        投稿者:{{ $comment->user->name }}
            </p>
        </div>
    </div>
    @endforeach
    <a href="{{ route('comment.create', ['post_id' => $post->id])}}" class="btn btn-primary">コメントをする</a>
</div>
@endsection
