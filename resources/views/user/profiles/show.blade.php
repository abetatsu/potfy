@extends('layouts.app')

@section('content')
<div class="container mt-5">
    @include('layouts.flash-messages')
    <div class="row justify-content-center">
        <div class="col-md-5 text-center">
            <img src="{{ $user->image }}" alt="画像は未設定です。" class="mb-3 mx-auto rounded-circle" height="120" width="120">
            <p class="text-xl font-bold mb-3">{{ $user->name }}</p>
            <p class="card-text">メールアドレス：{{ $user->email }}</p>
            <p class="card-text">性別：{{ $user->gender }}</p>
            <p class="card-text">キャリア：{{ $user->career }}</p>
            <p class="card-text">誕生日：{{ $user->birthday }}</p>
            <p class="card-text">自己紹介：{{ $user->user_self_introduction }}</p>
            <a href="{{route('user.users.edit', $user)}}" class="btn bg-potfyYellow hover:bg-potfyYellowTitle text-white font-bold py-2 px-4 rounded-full mt-4">編集する</a>
        </div>
    </div>
    <div class="row justify-content-center mt-5">
        <div class="col-md-10">
            <p class="text-lg font-bold mb-3">全ての投稿</p>
            <div class="row text-center">
                @if (count($portfolios) !== 0)
                @foreach ($portfolios as $portfolio)
                    @include('components.portfolio-card')
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
