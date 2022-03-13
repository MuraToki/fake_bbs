@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-md-8 col-md-offset-2 m-auto">
    <form method="POST" action="{{ route('store') }}" onSubmit="return checkSubmit()" enctype="multipart/form-data">
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
                <label for="title">
                    タイトル
                </label>
                <input id="title" name="title" class="form-control" value="{{ old('title') }}" type="text">
            
            </div>
            <div class="form-group">
                <label for="exampleFormControlFile1">Example file input</label>
                <input type="file" class="form-control-file" id="exampleFormControlFile1" name="image">
              </div>
            <div class="form-group">
                    <label for="exampleFormControlSelect1">category</label>
                    <select class="form-control" id="exampleFormControlSelect1" name="category_id">
                        <option selected="">選択する</option>
                        <option value="1">book</option>
                        <option value="2">English</option>
                        <option value="3">travel</option>
                    </select>
                </div>
            <div class="form-group">
                <label for="comment">
                    Comment
                </label>
                <textarea id="comment" name="content" class="form-control" rows="4" ></textarea>
            </div>
            <div class="mt-3">
              <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                <button type="submit" class="btn btn-dark">
                    投稿
                </button>
            </div>
        </form>
    </div>
</div>
@endsection