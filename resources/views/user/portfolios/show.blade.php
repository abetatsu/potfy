@extends('layouts.user.app')

@section('content')
@if (session('message'))
            <div class="alert alert-success col-6 offset-3">{{ session('message') }}</div>
        @endif
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-header">
                <h5>タイトル：{{ $portfolio->title }}</h5>
            </div>
            <div class="card-body">
                <div class="row my-5">
                    <div class="col-6 ml-3">
                        <p class="card-text">内容：{{ $portfolio->description }}</p>
                        <p class="card-text">リンク：{{ $portfolio->link }}</p>
                        <p>投稿日時：{{ $portfolio->created_at }}</p>
                        <p class="card-text">投稿者：{{ $portfolio->user->name }}</p>
                        <a href="{{route('user.portfolios.edit',$portfolio->id)}}" class="btn btn-primary mt-3">編集する</a>
                        <form action="{{ route('user.portfolios.destroy', $portfolio->id) }}'"method='post'>
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <input type='submit' value='削除' class="btn btn-danger" onclick='return confirm("削除しますか？？");'>
                        </form>
                    </div>
                    <div class="col-4">
                        <img src="{{ $portfolio->image_path }}" alt="画像">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="{{ route('user.comments.store', $portfolio->id) }}" method="POST">
            {{csrf_field()}}
                <input type="hidden" name="portfolio_id" value="{{ $portfolio->id }}">
                <div class="form-group">
                    <label>コメント</label>
                    <textarea class="form-control" placeholder="内容" rows="5" name="body"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">コメントする</button>
            </form>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            @foreach ($portfolio->comments as $comment)
            <div class="card mt-3">
                <h5 class="card-header">投稿者：{{ $comment->user->name }}</h5>
                <div class="card-body">
                    <h5 class="card-title">投稿日時：{{ $comment->created_at }}</h5>
                    <p class="card-text">内容：{{ $comment->body }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
</div>
@endsection