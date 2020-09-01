@extends('layouts.user.app')

@section('content')
</div>
        <div class="col-md-2">
            <a href="{{ route('user.portfolios.create')}}" class="btn btn-primary">新規投稿</a>
        </div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @include('layouts.flash-messages')
            <h1 class="text-center mt-5">Comment</h1>
            <div class="card text-center mt-2">
                <div class="card-header">
                    投稿一覧
                </div>
                @foreach ($portfoliosComments as $portfolioComment)
                <div class="card-body">
                    <h5 class="card-title">タイトル：{{ $portfolioComment->title }}</h5>
                    <p class="card-text">内容：{{ $portfolioComment->description }}</p>
                    <p class="card-text">リンク：{{ $portfolioComment->link }}</p>
                    <p class="card-text">投稿者：{{ $portfolioComment->user->name }}</p>
                    <a href="{{route('user.portfolios.show',$portfolioComment->id)}}" class="btn btn-primary">詳細へ</a>
                </div>
                <div class="card-footer text-muted">
                    投稿日時：{{ $portfolioComment->created_at }}
                </div>
                @endforeach
            </div>
            <h1 class="text-center mt-5">New Portfolios</h1>
            <div class="card text-center mt-2">
                <div class="card-header">
                    投稿一覧
                </div>
                @foreach ($portfolios as $portfolio)
                <div class="card-body">
                    <h5 class="card-title">タイトル：{{ $portfolio->title }}</h5>
                    <p class="card-text">内容：{{ $portfolio->description }}</p>
                    <p class="card-text">リンク：{{ $portfolio->link }}</p>
                    <p class="card-text">投稿者：{{ $portfolio->user->name }}</p>
                    <a href="{{route('user.portfolios.show',$portfolio->id)}}" class="btn btn-primary">詳細へ</a>
                </div>
                <div class="card-footer text-muted">
                    投稿日時：{{ $portfolio->created_at }}
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection