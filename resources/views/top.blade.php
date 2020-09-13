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
                    @include('components.portfolio-card')
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
