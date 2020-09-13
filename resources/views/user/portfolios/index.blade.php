@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10 text-center">
            <p class="text-lg font-bold mb-3">投稿一覧</p>
            @include('layouts.flash-messages')
            <div class="row mb-3">
                @foreach ($portfolios as $portfolio)
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
                @endforeach
            </div>
            <div class="row justify-center">
                {{ $portfolios->links() }}
            </div>
        </div>
    </div>
    </div>
</div>
@endsection
