@extends('layouts.app')

@section('content')
<div class="container mt-5">
    @include('layouts.flash-messages')
    <div class="row justify-content-center">
        <div class="col-md-5 text-center">
            <img src="{{ isset($user->image) ? $user->image : '/assets/image/android-chrome-192x192.png' }}" alt="画像は未設定です。" class="mb-3 mx-auto rounded-circle" height="120" width="120">
            <p class="text-xl font-bold mb-3">{{ $user->name }}</p>
            <p class="card-text">{!! nl2br($introduction) !!}</p>
            <div class="socialIcon__group">
                @foreach ($user->socialAccounts as $account)
                    @if ($account->social_type === 'github')
                        <a href="{{ $account->url }}" class="socialIcon__groupLogo" target="_blank">
                            <i class="fab fa-github color-github"></i>
                        </a>
                    @elseif ($account->social_type === 'twitter')
                        <a href="{{ $account->url }}" class="socialIcon__groupLogo" target="_blank">
                            <i class="fab fa-twitter color-twitter"></i>
                        </a>
                    @elseif ($account->social_type === 'wantedly')
                        <a href="{{ $account->url }}" class="socialIcon__groupLogo" target="_blank">
                            <img src="{{ asset('assets/image/wantedly_mark.png') }}" alt="" class="socialIcon__group-img">
                        </a>
                    @endif
                @endforeach
            </div>
            @if (Auth::id() === $user->id)
                <a href="{{route('users.edit', $user)}}" class="btn bg-potfyYellow hover:bg-potfyYellowTitle text-white font-bold py-2 px-4 rounded-full mt-4">プロフィールを編集する</a>
            @endif
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
                        <p>現在、まだポートフォリオの投稿はありません。</p>
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
