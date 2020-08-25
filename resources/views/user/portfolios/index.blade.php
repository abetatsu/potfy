@extends('layouts.user.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 text-center">
            <p class="text-lg font-bold mb-3">新着の投稿</p>
            @include('layouts.flash-messages')
            <div class="row">
                @foreach ($portfolios as $portfolio)
                <div class="col-md-3 mb-3">
                    <a href="{{route('user.portfolios.show',$portfolio->id)}}" class="no-underline hover:no-underline">
                        <div class="card shadow transition duration-500 ease-in-out transform hover:-translate-y-1 hover:scale-105">
                            <img class="card-img-top object-cover h-48 w-full" src="{{ isset($portfolio->image_path) ? $portfolio->image_path : 'https://res.cloudinary.com/dlalfv68e/image/upload/v1598249615/v8ycx2qljsz6u4lzcosm.png' }}" alt="画像の登録はありません">
                            <div class="card-body">
                                <h5 class="card-title">タイトル：{{ $portfolio->title }}</h5>
                                <p class="card-text">内容：{{ $portfolio->description }}</p>
                                <p class="card-text">リンク：{{ $portfolio->link }}</p>
                                <p class="card-text">投稿者：{{ $portfolio->user->name }}</p>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection