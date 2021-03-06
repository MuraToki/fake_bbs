@extends('layouts.app')

@section('content')
<div class="card-header">{{ $user->name }}の投稿</div>
  <div class="card-body">
    @if (session('status'))
      <div class="alert alert-success" role="alert">
        {{ session('status') }}
      </div>
    @endif    
    <div class="card">
      @foreach ($user->posts as $post)                   
      <div class="card-body">
        <h5 class="card-title">{{ $post->title }}</h5>
        <p class="card-title">カテゴリー:
            <a href="{{ route('home', ['category_id' => $post->category_id]) }}">{{ $post->category->category_name }}</a>
        </p>
        <p class="card-title">投稿者:
        <a href="{{ route('posts.show', [$post->user_id]) }}">
            {{ $post->user->name }}
        </a>    
        </p>
        <p class="card-text">{{ $post->content}}</p>
        <a href="{{ route('show', $post->id)}}" class="btn btn-primary">詳細</a>
      </div>
      @endforeach 
</div>
</div>
@endsection