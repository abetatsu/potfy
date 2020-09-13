@extends('layouts.app')

@section('content')
<div style="background-image: url({{ asset('assets/image/potfybg.jpeg') }}); " class="bg-cover bg-center">
    <div style="background-color: rgba(0,0,0,0.1);">
        <div class="container py-20 lg:py-48">
            <div class="text-center">
                <p class="text-6xl text-gray-100 tracking-widest mb-3">Potfy.me</p>
                <p><a href="{{ route('user.portfolios.index')}}" class="btn bg-potfyYellow hover:bg-potfyYellowTitle text-white font-bold py-2 px-4 rounded-full">早速使ってみる</a></p>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-10 text-center">
            <p class="text-lg font-bold mb-3">新着の投稿</p>
            @include('layouts.flash-messages')
            <div class="row">
                @foreach ($portfolios as $portfolio)
                    @include('components.portfolio-card')
                @endforeach
            </div>
        </div>
    </div>
    <div class="row justify-center mt-5">
        <div class="col-md-10 text-center">
            <p class="text-lg font-bold mb-3">人気の投稿</p>
            <div class="row mb-3">
                @foreach ($topPortfolios as $portfolio)
<<<<<<< HEAD
                    @include('components.portfolio-card')
=======
                <div class="col-xl-4 col-md-6 mb-3">
                    <div class="card shadow transition duration-500 ease-in-out transform hover:-translate-y-1 hover:scale-105" style="height: 385px;">
                        <a href="{{route('user.portfolios.show',$portfolio->id)}}" class="no-underline hover:no-underline">
                            <img class="card-img-top object-cover h-48 w-full" src="{{ isset($portfolio->image_path) ? $portfolio->image_path : 'https://res.cloudinary.com/dlalfv68e/image/upload/v1598249615/v8ycx2qljsz6u4lzcosm.png' }}" alt="画像の登録はありません">
                            <div class="card-body pb-0">
                                <h5 class="card-title font-extrabold text-left">{{ RoundSentence($portfolio->title, 19, 18) }}</h5>
                                <p class="card-text text-left" style="height: 90px">{!! RoundSentence($portfolio->description, 74, 75) !!}</p>
                            </div>
                        </a>
                        <a href="{{ route('user.users.show', $portfolio->user_id) }}" class="d-flex justify-content-end align-items-center pr-4 my-2">
                            <img src="{{ ($portfolio->user->image)?$portfolio->user->image: '/assets/image/android-chrome-192x192.png' }}" alt="" class="rounded-circle h-10 p-2">
                            <h3 class="card-text">{{ empty($portfolio->user->name)? 'ゲスト'.$portfolio->user->id: $portfolio->user->name }}</h3>
                        </a>
                    </div>
                </div>
>>>>>>> 8b5746f5f0f05c8b522ebbe229eeff78e6a60dd7
                @endforeach
            </div>
            <a href="{{ route('user.portfolios.index')}}" class="btn bg-potfyYellow hover:bg-potfyYellowTitle text-white font-bold py-2 px-4 rounded-full">もっと見る</a>
        </div>
    </div>
    <div class="row justify-center mt-5">
        <div class="col-md-10 text-center">
            <p class="text-lg font-bold mb-3">使い方</p>
        </div>
    </div>
</div>
@endsection
