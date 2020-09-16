@extends('layouts.user.auth')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 text-center my-5">
            <p class="text-4xl font-bold">ようこそ <span class="text-potfyYellowTitle">Potfy.me</span> へ</p>
        </div>
        <div class="col-12 text-center mb-5">
            <p class="font-bold text-lg">Potfy.meアカウントを開設してサービスを利用しよう</p>
        </div>
    </div>
    <div class="row">
        <div class="col-12 text-center mb-5">
            <a href="{{ route('user.login.twitter') }}" class="btn bg-potfyYellow hover:bg-potfyYellowTitle text-white font-bold py-2 px-4 rounded-full"><i class="fab fa-twitter"></i>　Twitterアカウントを利用してログイン</a>
        </div>
        <div class="col-12 text-center mb-5">
            <a href="{{ route('user.login.github') }}" class="btn bg-potfyYellow hover:bg-potfyYellowTitle text-white font-bold py-2 px-4 rounded-full"><i class="fab fa-github"></i>　GitHubアカウントを利用してログイン</a>
        </div>
    </div>
    <div class="row text-center justify-center align-items-center mb-4">
        <div class="col-md-4 d-none d-sm-block">
            <hr size="5">
        </div>
        <div class="col-md-2">
            <p>または</p>
        </div>
        <div class="col-md-4 d-none d-sm-block">
            <hr size="5">
        </div>
    </div>
    <div class="row justify-center">
        <div class="col-md-8">
        <form method="POST" action="{{ route('user.login') }}">
            @csrf
            <div class="form-group row mb-5">
                <div class="col-md-6">
                    <label for="email" class="col-form-label">{{ __('メールアドレス') }}</label>
                    <input id="email" placeholder="メールアドレスを入力してください" type="email" class="form-control @error('email') is-invalid @enderror bg-white focus:outline-none focus:shadow-outline border border-gray-300 rounded-full py-2 px-4 block w-full appearance-none leading-normal" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="password" class="col-form-label text-md-right">{{ __('パスワード') }}</label>
                    <input id="password" placeholder="パスワードを入力してください" type="password" class="form-control @error('password') is-invalid @enderror bg-white focus:outline-none focus:shadow-outline border border-gray-300 rounded-full py-2 px-4 block w-full appearance-none leading-normal" name="password" required autocomplete="current-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="form-group row justify-center text-center mb-5">
                <div class="col-md-6">
                    <button type="submit" class="bg-potfyYellow hover:bg-potfyYellowTitle text-white font-bold py-2 px-4 rounded-full">
                        メールアドレスで{{ __('ログイン') }}
                    </button>
                </div>
            </div>
            <div class="form-group row justify-center text-center mb-5">
                <div class="col-md-6">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                        <label class="form-check-label" for="remember">
                            {{ __('次回から自動的にログイン') }}
                        </label>
                    </div>
                </div>
            </div>
            <div class="row justify-center text-center">
                <div class="col-12">
                    <p>アカウントを持っていない方は<a href="{{ route('user.register') }}" class="text-blue-500">新規登録</a>して下さい</p>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

