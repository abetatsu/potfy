@extends('layouts.user.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @include('layouts.flash-messages')
            <div class="card-header">
                <h5>お名前：{{ $user->name }}</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6 ml-3">
                        <img src="{{ $user->image }}" alt="画像は未設定です。" class="mb-3" height="120" width="120">
                        <p class="card-text">メールアドレス：{{ $user->email }}</p>
                        <p class="card-text">性別：{{ $user->gender }}</p>
                        <p class="card-text">キャリア：{{ $user->career }}</p>
                        <p class="card-text">誕生日：{{ $user->birthday }}</p>
                        <p class="card-text">自己紹介：{{ $user->user_self_introduction }}</p>
                        <a href="{{route('user.users.edit', $user)}}" class="btn btn-primary mt-3">編集する</a>
                    </div>
                    <div class="col-4">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
