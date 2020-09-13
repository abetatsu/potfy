@extends('layouts.app')

@section('content')
<div class="container mt-5">
    @include('layouts.flash-messages')
    <div class="row justify-content-center">
        <div class="col-md-5 text-center">
            <img src="{{ $user->image }}" alt="画像は未設定です。" class="mb-3 mx-auto rounded-circle" height="120" width="120">
            <p class="text-xl font-bold mb-3">{{ $user->name }}</p>
            <p class="card-text">自己紹介：{!! $introduction !!}</p>
            @foreach ($user->socialAccounts as $account)
                <p>
                    <a href="{{ $account->url }}" class="text-blue-500" target="_blank">{{ App\Enums\SocialType::getDescription($account->social_type) }}</a>
                </p>
            @endforeach
            <a href="{{route('user.users.edit', $user)}}" class="btn bg-potfyYellow hover:bg-potfyYellowTitle text-white font-bold py-2 px-4 rounded-full mt-4">編集する</a>
        </div>
    </div>
    <div class="row justify-content-center mt-5">
        <div class="col-md-10">
            <p class="text-lg font-bold mb-3">全ての投稿</p>
            <div class="row text-center">
                @if (count($portfolios) !== 0)
                @foreach ($portfolios as $portfolio)
                <div class="col-xl-3 col-md-6 mb-3">
                    <div class="card shadow transition duration-500 ease-in-out transform hover:-translate-y-1 hover:scale-105">
                        <a href="{{route('user.portfolios.show',$portfolio->id)}}" class="no-underline hover:no-underline">
                            <img class="card-img-top object-cover h-48 w-full" src="{{ isset($portfolio->image_path) ? $portfolio->image_path : 'https://res.cloudinary.com/dlalfv68e/image/upload/v1598249615/v8ycx2qljsz6u4lzcosm.png' }}" alt="画像の登録はありません">
                            <div class="card-body pb-0">
                                <h5 class="card-title ">タイトル：{{ $portfolio->title }}</h5>
                                <p class="card-text">内容：{{ $portfolio->description }}</p>
                                <p class="card-text">リンク：{{ $portfolio->link }}</p>
                            </div>
                        </a>
                        <a href="{{ route('user.users.show', $portfolio->user_id) }}" class="d-flex justify-content-center align-items-center">
                            <img src="{{ $portfolio->user->image }}" alt="" class="rounded-circle h-10 p-2">
                            <h3 class="card-text">{{ $portfolio->user->name }}</h3>
                        </a>
                    </div>
                </div>
                @endforeach
                @else
                <div class="col-12 mb-3">
                    <p>あなたはまだポートフォリオを投稿していません。</p>
                </div>
                @endif
            </div>
        </div>
    </div>
    <div class="row justify-center">
        {{ $portfolios->links() }}
    </div>
</div>
@endsection
