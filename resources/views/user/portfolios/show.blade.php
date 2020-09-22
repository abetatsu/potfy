@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @include('layouts.flash-messages')
            <div class="card-header bg-white row shadow-sm">
                <div class="col-md-8 h-10 leading-10">
                    <h1 class="h3 h-10 leading-10 mb-0">{{ $portfolio->title }}</h1>
                </div>
                <div class="col-md-4 text-right">
                    <p>投稿日時：{{ $portfolio->created_at->diffForHumans(Carbon\Carbon::now()) }}</p>
                    <p>閲覧数：{{$portfolio->visited_count}}</p>
                </div>
            </div>
            <div class="card-body pt-5">
                <div class="row">
                    <img class="object-cover w-1/2 mx-auto" src="{{ isset($portfolio->image_path) ? $portfolio->image_path : 'https://res.cloudinary.com/dlalfv68e/image/upload/v1598249615/v8ycx2qljsz6u4lzcosm.png' }}" alt="画像の登録はありません">
                </div>
                <div class="row mt-5">
                    <p class="card-text">{!! nl2br($description) !!}</p>
                </div>
                <div class="row my-2">
                    <p class="card-text">使用した技術：
                        @foreach ($portfolio->technologies as $technology)
                            <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2">
                                {{ $technology->name }}
                            </span>
                        @endforeach
                    </p>
                </div>
                <div class="row my-2">
                    <p class="card-text">プロダクトURL：{!! $link !!}</p>
                </div>
                <div class="row my-2">
                    <a href="{{ route('users.show', $portfolio->user_id) }}" class="d-flex justify-content-center align-items-center text-blue-500">
                        <img src="{{ isset($portfolio->user->image) ? $portfolio->user->image : '/assets/image/android-chrome-192x192.png' }}" alt="" class="rounded-circle h-10 p-2">
                        <h3 class="card-text">{{ empty($portfolio->user->name)? 'Guest' : $portfolio->user->name }}</h3>
                    </a>
                </div>
                <div class="row my-5">
                    @if ($portfolio->user_id === Auth::user()->id)
                    <div class="col-3">
                        <a href="{{route('user.portfolios.edit',$portfolio->id)}}" class="btn bg-potfyYellow hover:bg-potfyYellowTitle text-white font-bold py-2 px-4 rounded-full col-12">編集する</a>
                    </div>
                    <div class="col-3">
                        <a class="btn bg-potfyYellow hover:bg-potfyYellowTitle text-white font-bold py-2 px-4 rounded-full col-12" 
                            href="https://twitter.com/share?url={{ route('portfolios.show', $portfolio->id) }}&hashtags=potfy&text=開発者募集中です！" 
                            onclick="return confirm('https:\/\/twitter.com に遷移しようとしています。本当に実行してよろしいでしょうか?')" rel="nofollow" target="_blank">
                            開発者を募る
                        </a>
                    </div>
                    <div class="col-3">
                        <form action="{{ route('user.portfolios.destroy', $portfolio->id) }}" method='post'>
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <input type='submit' value='削除する' class="btn bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-full col-12" onclick='return confirm("削除しますか？？");'>
                        </form>
                    </div>
                    @endif
                    <div class="col-3">
                        <url-copy-component></url-copy-component>
                    </div>
                    @if ($portfolio->user_id !== Auth::user()->id)
                    <div class="col-3">
                        <a class="btn bg-potfyYellow hover:bg-potfyYellowTitle text-white font-bold py-2 px-4 rounded-full col-12" 
                        href="https://twitter.com/share?url={{ route('portfolios.show', $portfolio->id) }}&hashtags=potfy&text={{ $portfolio->title }}というサービスを見つけました！" 
                        onclick="return confirm('https:\/\/twitter.com に遷移しようとしています。本当に実行してよろしいでしょうか?')" rel="nofollow" target="_blank">
                        Twitterでシェア
                    </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        <ul class="nav nav-tabs text-center col-8">
            <li class="col-4 p-0 nav-item"><a href="#story" class="nav-link {{ session('history') || session('comment') ? '' : 'active'}}" data-toggle="tab">ストーリー</a></li>
            <li class="col-4 p-0 nav-item"><a href="#history" class="nav-link {{ session('history') ? 'active' : ''}}" data-toggle="tab">開発履歴</a></li>
            <li class="col-4 p-0 nav-item"><a href="#comments" class="nav-link {{ session('comment') ? 'active' : ''}}" data-toggle="tab">コメント</a></li>
        </ul>
    </div>

    <div class="tab-content">
        <div class="{{ session('comment') ? 'active show' : ''}} tab-pane fade " id="comments">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    @auth
                    <form action="{{ route('user.comments.store', $portfolio->id) }}" method="POST">
                        {{csrf_field()}}
                        <input type="hidden" name="portfolio_id" value="{{ $portfolio->id }}">
                        <div class="mt-4 form-group">
                            <textarea class="form-control" placeholder="内容" rows="5" name="body"></textarea>
                        </div>
                        <button type="submit" class="btn bg-potfyYellow hover:bg-potfyYellowTitle text-white font-bold py-2 px-4 rounded-full col-3">コメントを投稿する</button>
                    </form>
                    @endauth
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    @if($portfolio->comments->count() !== 0)
                        @foreach ($portfolio->comments as $comment)
                        <div class="card mt-5">
                            <div class="card-header py-2 d-flex justify-content-between align-items-center">
                                <a href="{{ route('users.show', $comment->user_id) }}" class="d-flex align-items-center">
                                    <img src="{{ ($comment->user->image) ? $comment->user->image: '/assets/image/android-chrome-192x192.png' }}" alt="" class="rounded-circle h-10 p-2">
                                    <h3 class="card-text">{{ empty($comment->user->name)? 'Guest' : $comment->user->name }}</h3>
                                </a>
                                <p class="ml-auto">
                                    投稿日時：{{ $comment->created_at->diffForHumans(Carbon\Carbon::now()) }}
                                </p>
                                @if(Auth::id() === $portfolio->user_id || Auth::id() === $comment->user_id)
                                    <ul class="navbar-nav">
                                        <li class="nav-item dropdown">
                                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre><span class="caret"></span>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                                @if (Auth::id() === $comment->user_id)
                                                    <button type="button" class="dropdown-item" data-toggle="modal" data-target="#commentModal{{ $comment->id }}" data-whatever="@mdo">編集する</button>
                                                @endif
                                                <form action="{{ route('user.comments.destroy', [$portfolio->id, $comment->id]) }}" method='post' class="dropdown-item">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}
                                                    <input type='submit' class="bg-transparent btn px-0" value='削除する' onclick='return confirm("本当に削除しますか?");'>
                                                </form>
                                            </div>
                                        </li>
                                    </ul>
                                @endif
                            </div>
                            @include('user.portfolios._comment-modal', ['comment' => $comment])
                            <div class="card-body">
                                <p class="card-text">{!! nl2br($comment->body) !!}</p>
                            </div>
                        </div>
                        @endforeach
                    @endif
                    <div class="my-5">
                        @if($portfolio->comments->count() === 0 && auth()->guest())
                            <p>現在、まだコメントの投稿はありません。コメントの投稿には<a class="text-blue-500" href="{{ route('user.login') }}">ログイン</a>が必要です。</p>
                        @elseif(auth()->guest())
                            <p>コメントの投稿には<a class="text-blue-500" href="{{ route('user.login') }}">ログイン</a>が必要です。</p>
                        @elseif($portfolio->comments->count() === 0)
                            <p>現在、まだコメントの投稿はありません。</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="{{ session('history') ? 'active show' : ''}} tab-pane fade" id="history">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    @if(Auth::user()->id === $portfolio->user_id)
                    <form action="{{ route('user.histories.store',$portfolio->id) }}" method="POST">
                        {{csrf_field()}}
                        <input type="hidden" name="portfolio_id" value="{{$portfolio->id}}">
                        <div class="mt-4 form-group">
                            <textarea class="form-control" placeholder="内容" rows="5" name="history"></textarea>
                        </div>
                        <button type="submit" class="btn bg-potfyYellow hover:bg-potfyYellowTitle text-white font-bold py-2 px-4 rounded-full col-3">開発履歴を投稿する</button>
                    </form>
                    @endif
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    @if($portfolio->histories->count() !== 0)
                        @foreach ($portfolio->histories as $history)
                        <div class="card mt-5">
                            <div class="card-header py-2 d-flex justify-content-between align-items-center">
                                <a href="{{ route('users.show', $history->user_id) }}" class="d-flex align-items-center">
                                    <img src="{{ ($history->user->image) ? $history->user->image: '/assets/image/android-chrome-192x192.png' }}" alt="" class="rounded-circle h-10 p-2">
                                    <h3 class="card-text">{{ empty($history->user->name)? 'Guest' : $history->user->name }}</h3>
                                </a>
                                <p class="ml-auto">
                                    投稿日時：{{ $history->created_at->diffForHumans(Carbon\Carbon::now()) }}
                                </p>
                                @if(Auth::id() === $portfolio->user_id || Auth::id() === $history->user_id)
                                    <ul class="navbar-nav">
                                        <li class="nav-item dropdown">
                                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre><span class="caret"></span>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                                <button type="button" class="dropdown-item" data-toggle="modal" data-target="#historyModal{{ $history->id }}" data-whatever="@mdo">編集する</button>
                                                <form action="{{ route('user.histories.destroy', [$portfolio->id, $history->id]) }}" method='post' class="dropdown-item">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}
                                                    <input type='submit' class="bg-transparent btn px-0" value='削除する' onclick='return confirm("本当に削除しますか?");'>
                                                </form>
                                            </div>
                                        </li>
                                    </ul>
                                @endif
                            </div>
                            @include('user.portfolios._history-modal', ['history' => $history])
                            <div class="card-body">
                                <p class="card-text">{!! nl2br($history->history) !!}</p>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <div class="my-5">
                            <p>現在、まだ開発履歴の投稿はありません。</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="{{ session('history') || session('comment') ? : 'active show'}} tab-pane fade" id="story">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    @if(Auth::user()->id === $portfolio->user_id)
                    <form action="{{ route('user.stories.store', $portfolio->id) }}" method="POST">
                        {{csrf_field()}}
                        <input type="hidden" name="portfolio_id" value="{{ $portfolio->id }}">
                        <div class="mt-4 form-group">
                            <select name="story_type"
                            class="block appearance-none w-full border py-2 px-2 pr-8 mb-2 rounded leading-tight">
                                <option value="0">選択してください</option>
                                @foreach (App\Enums\StoryType::asSelectArray() as $storyTypeEn => $storyTypeJp)
                                    <option value="{{ $storyTypeEn }}">{{ $storyTypeJp }}</option>
                                @endforeach
                            </select>
                            <textarea class="form-control" placeholder="内容" rows="5" name="story"></textarea>
                        </div>
                        <button type="submit" class="btn bg-potfyYellow hover:bg-potfyYellowTitle text-white font-bold py-2 px-4 rounded-full col-3">ストーリーを投稿する</button>
                    </form>
                    @endif
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    @if($portfolio->stories->count() !== 0)
                        @foreach ($portfolio->stories as $story)
                            <div class="mt-5 py-2 col-3 bg-potfyYellow text-white font-bold text-center rounded-top">
                                {{App\Enums\StoryType::getDescription($story->story_type)}}
                            </div>
                            <div class="card">
                                <div class="card-header py-2 d-flex justify-content-between align-items-center">
                                    <a href="{{ route('users.show', $story->user_id) }}" class="d-flex align-items-center">
                                        <img src="{{ ($story->user->image) ? $story->user->image: '/assets/image/android-chrome-192x192.png' }}" alt="" class="rounded-circle h-10 p-2">
                                        <h3 class="card-text">{{ empty($story->user->name)? 'Guest' : $story->user->name }}</h3>
                                    </a>
                                    <p class="ml-auto">
                                        投稿日時：{{ $story->created_at->diffForHumans(Carbon\Carbon::now()) }}
                                    </p>
                                    @if(Auth::id() === $portfolio->user_id || Auth::id() === $story->user_id)
                                        <ul class="navbar-nav">
                                            <li class="nav-item dropdown">
                                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre><span class="caret"></span>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                                    <button type="button" class="dropdown-item" data-toggle="modal" data-target="#storyModal{{ $story->id }}" data-whatever="@mdo">編集する</button>
                                                    <form action="{{ route('user.stories.destroy', [$portfolio->id, $story->id]) }}" method='post' class="dropdown-item">
                                                        {{ csrf_field() }}
                                                        {{ method_field('DELETE') }}
                                                        <input type='submit' class="bg-transparent btn px-0" value='削除する' onclick='return confirm("本当に削除しますか?");'>
                                                    </form>
                                                </div>
                                            </li>
                                        </ul>
                                    @endif
                                </div>
                                @include('user.portfolios._story-modal', ['story' => $story])
                                <div class="card-body">
                                    <p class="card-text">{!! nl2br($story->story) !!}</p>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="my-5">
                            <p>現在、まだストーリーの投稿はありません。</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
