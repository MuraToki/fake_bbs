@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-md-8 col-md-offset-2 m-auto">
    <form method="POST" action="{{ route('comment.store') }}" onSubmit="return checkSubmit()">
      @csrf
      @if ($errors->any())
          <div class="text-danger">
            <ul>
              @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
            </ul>

          </div>
      @endif

            <div class="form-group">
                <label for="comment">
                    Comment
                </label>
                <textarea id="comment" name="comment" class="form-control" rows="4" ></textarea>
            </div>
            <div class="mt-3">
              <input type="hidden" name="user_id" value="{{ Auth::id() }}">
              <input type="hidden" name="post_id" value="{{ $post_id }}">
                <button type="submit" class="btn btn-dark">
                    投稿
                </button>
            </div>
        </form>
    </div>
</div>
@endsection