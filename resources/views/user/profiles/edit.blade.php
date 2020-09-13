@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="{{ route('user.users.update', $user) }}" method="POST" enctype="multipart/form-data">
            {{csrf_field()}}
            {{method_field('PATCH')}}
                <div class="row form-group">
                    <div class="col-3">
                        <img src="{{ $user->image }}" alt="画像は未設定です。" class="mb-3" height="120" width="120">
                        <input type="file" class="form-control-file" id="image" name="image">
                    </div>
                    <div class="col-9">
                        <label>ユーザー</label>
                        <input type="text" class="form-control" value="{{ old('name', $user->name) }}" name="name">
                    </div>
                </div>
                <div class="form-group">
                    <label>キャリア</label>
                    <input type="text" class="form-control" value="{{ old('career', $user->career) }}" name="career" placeholder="キャリアを記入してください">
                </div>
                <div class="form-group">
                    <label>誕生日</label>
                    <input type="date" class="form-control" value="{{ old('birthday', $user->birthday) }}" name="birthday">
                </div>
                <div class="form-group">
                    <label>自己紹介</label>
                    <textarea class="w-100" name="user_self_introduction" rows="10" placeholder="自己紹介を記入してください">{{ old('user_self_introduction', $user->user_self_introduction) }}</textarea>
                </div>
                <div class="form-group">
                    <label>{{ App\Enums\SocialType::getDescription(App\Enums\SocialType::GITHUB) }}</label>
                    <input type="url" class="form-control" value="{{ array_key_exists(App\Enums\SocialType::GITHUB, $socialAccounts) ? $socialAccounts[App\Enums\SocialType::GITHUB] : '' }}" name="social_accounts[{{ App\Enums\SocialType::GITHUB }}]">
                </div>
                <div class="form-group">
                    <label>{{ App\Enums\SocialType::getDescription(App\Enums\SocialType::TWITTER) }}</label>
                    <input type="url" class="form-control" value="{{ array_key_exists(App\Enums\SocialType::TWITTER, $socialAccounts) ? $socialAccounts[App\Enums\SocialType::TWITTER] : '' }}" name="social_accounts[{{ App\Enums\SocialType::TWITTER }}]">
                </div>
                <div class="form-group">
                    <label>{{ App\Enums\SocialType::getDescription(App\Enums\SocialType::WANTEDLY) }}</label>
                    <input type="url" class="form-control" value="{{ array_key_exists(App\Enums\SocialType::WANTEDLY, $socialAccounts) ? $socialAccounts[App\Enums\SocialType::WANTEDLY] : '' }}" name="social_accounts[{{ App\Enums\SocialType::WANTEDLY }}]">
                </div>
                <button type="submit" class="bg-potfyYellow hover:bg-potfyYellowTitle text-white font-bold py-2 px-4 rounded-full">
                    更新する
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
