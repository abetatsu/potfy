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
                    <label>自己紹介</label>
                    <textarea class="w-100 form-control" name="user_self_introduction" rows="10" placeholder="自己紹介を記入してください">{{ old('user_self_introduction', $user->user_self_introduction) }}</textarea>
                </div>
                <div class="form-group">
                    <label>{{ App\Enums\SocialType::getDescription(App\Enums\SocialType::GITHUB) }}</label>
                    <input type="url" class="form-control" placeholder="あなたのGitHubリンクを入力してください" value="{{ array_key_exists(App\Enums\SocialType::GITHUB, $socialAccounts) ? $socialAccounts[App\Enums\SocialType::GITHUB] : '' }}" name="social_accounts[{{ App\Enums\SocialType::GITHUB }}]">
                </div>
                <div class="form-group">
                    <label>{{ App\Enums\SocialType::getDescription(App\Enums\SocialType::TWITTER) }}</label>
                    <input type="url" class="form-control" placeholder="あなたのTwitterリンクを入力してください" value="{{ array_key_exists(App\Enums\SocialType::TWITTER, $socialAccounts) ? $socialAccounts[App\Enums\SocialType::TWITTER] : '' }}" name="social_accounts[{{ App\Enums\SocialType::TWITTER }}]">
                </div>
                <div class="form-group">
                    <label>{{ App\Enums\SocialType::getDescription(App\Enums\SocialType::WANTEDLY) }}</label>
                    <input type="url" class="form-control" placeholder="あなたのWantedlyリンクを入力してください" value="{{ array_key_exists(App\Enums\SocialType::WANTEDLY, $socialAccounts) ? $socialAccounts[App\Enums\SocialType::WANTEDLY] : '' }}" name="social_accounts[{{ App\Enums\SocialType::WANTEDLY }}]">
                </div>
                <div class="form-group">
                    <label>性別</label>
                    <select name="gender" class="block appearance-none w-full border py-2 px-2 pr-8 rounded leading-tight">
                        <option {{ old('gender') === 'other' || $user->gender === 'other' ? 'selected' : '' }} value="other">その他</option>
                        <option {{ old('gender') === 'male' || $user->gender === 'male' ? 'selected' : '' }} value="male">男性</option>
                        <option {{ old('gender') === 'female' || $user->gender === 'female' ? 'selected' : '' }} value="female">女性</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>前職</label>
                    <input type="text" class="form-control" value="{{ old('career', $user->career) }}" name="career" placeholder="前職を記入してください">
                </div>
                <div class="form-group">
                    <label>誕生日</label>
                    <input type="date" class="form-control" value="{{ old('birthday', $user->birthday) }}" name="birthday">
                </div>
                <div class="form-group">
                    <label>学歴</label>
                    <input type="text" class="form-control" value="{{ old('academic_background', $user->academic_background) }}" name="academic_background" placeholder="最終学歴を記入してください">
                </div>
                <div class="form-group">
                    <label>出身</label>
                    <input type="text" class="form-control" value="{{ old('home_village', $user->home_village) }}" name="home_village" placeholder="出身地を入力してください。">
                </div>
                <div class="form-group">
                    <label>現住所</label>
                    <input type="text" class="form-control" value="{{ old('current_residence', $user->current_residence) }}" name="current_residence" placeholder="現在お住まいの地域をご入力ください。">
                </div>
                <button type="submit" class="bg-potfyYellow hover:bg-potfyYellowTitle text-white font-bold py-2 px-4 rounded-full">
                    更新する
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
