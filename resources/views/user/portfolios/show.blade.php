@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @include('layouts.flash-messages')
            <div class="card-header">
                <h5>タイトル：{{ $portfolio->title }}</h5>
            </div>
            <div class="card-body">
                <div class="row my-5">
                    <div class="col-6 ml-3">
                        <p class="card-text">内容：{!! $description !!}</p>
                        <p class="card-text">リンク：<a href="{{ $portfolio->link }}" class="text-blue-500" target="_blank">{{ $portfolio->link }}</a></p>
                        <p>投稿日時：{{ $portfolio->created_at }}</p>
                        <p class="card-text">投稿者：{{ $portfolio->user->name }}</p>
                        <p>閲覧数：{{$portfolio->visited_count}}</p>
                        <p class="card-text">開発言語：
                            @foreach ($portfolio->technologies as $technology)
                            {{ $technology->name}}
                            @endforeach
                        </p>
                    </div>
                    <div class="col-4">
                        <img src="{{ $portfolio->image_path }}" alt="画像">
                    </div>
                </div>
                <div class="row">
                    @if ($portfolio->user_id === Auth::id())
                    <div class="col-3">
                        <a href="{{route('user.portfolios.edit',$portfolio->id)}}" class="btn bg-potfyYellow hover:bg-potfyYellowTitle text-white font-bold py-2 px-4 rounded-full col-12">編集する</a>
                    </div>
                    <div class="col-3">
                        <a class="btn bg-potfyYellow hover:bg-potfyYellowTitle text-white font-bold py-2 px-4 rounded-full col-12" href="https://twitter.com/share?url={{ route('user.portfolios.show', $portfolio->id) }}&via=gaogaogate&hashtags=potfy,gaogaogate&text=開発者募集中です！" rel="nofollow" target="_blank">開発者を募る</a>
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
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="{{ route('user.comments.store', $portfolio->id) }}" method="POST">
            {{csrf_field()}}
                <input type="hidden" name="portfolio_id" value="{{ $portfolio->id }}">
                <div class="form-group">
                    <label>コメント</label>
                    <textarea class="form-control" placeholder="内容" rows="5" name="body"></textarea>
                </div>
                <button type="submit" class="btn bg-potfyYellow hover:bg-potfyYellowTitle text-white font-bold py-2 px-4 rounded-full col-3">コメントを投稿する</button>
            </form>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            @foreach ($portfolio->comments as $comment)
            <div class="card mt-3">
                <h5 class="card-header">投稿者：{{ $comment->user->name }}</h5>
                <div class="card-body">
                    <h5 class="card-title">投稿日時：{{ $comment->created_at }}</h5>
                    <p class="card-text">内容：{{ $comment->body }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="{{ route('user.histories.store',$portfolio->id) }}" method="POST">
            {{csrf_field()}}
                <input type="hidden" name="portfolio_id" value="{{$portfolio->id}}">
                <div class="form-group">
                    <label>開発履歴</label>
                    <textarea class="form-control" placeholder="内容" rows="5" name="history"></textarea>
                </div>
                <button type="submit" class="btn bg-potfyYellow hover:bg-potfyYellowTitle text-white font-bold py-2 px-4 rounded-full col-3">開発履歴を投稿する</button>
            </form>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            @foreach ($portfolio->histories as $history)
            <div class="card mt-3">
                <h5 class="card-header">投稿者：{{ $history->user->name }}</h5>
                <div class="card-body">
                    <h5 class="card-title">投稿日時：{{ $history->created_at }}</h5>
                    <p class="card-text">内容：{{ $history->history }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="{{ route('user.stories.store', $portfolio->id) }}" method="POST">
                {{csrf_field()}}
                <input type="hidden" name="portfolio_id" value="{{ $portfolio->id }}">
                <div class="form-group">
                    <select name="story_type" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                        <option value="0">選択してください</option>
                        @foreach (App\Enums\StoryType::asSelectArray() as $storyTypeEn => $storyTypeJp)
                            <option value="{{ $storyTypeEn }}">{{ $storyTypeJp }}</option>
                        @endforeach
                    </select>
                    <label>ストーリー</label>
                    <textarea class="form-control" placeholder="内容" rows="5" name="story"></textarea>
                </div>
                <button type="submit" class="btn bg-potfyYellow hover:bg-potfyYellowTitle text-white font-bold py-2 px-4 rounded-full col-3">ストーリーを投稿する</button>
            </form>
        </div>
    </div>
    
    <div class="row justify-content-center">
        <div class="col-md-8">
        @foreach ($portfolio->stories as $story)
            <div class="card mt-3">
                <h5 class="card-header">投稿者：{{ $story->user->name }}</h5>
                <div class="card-body">
                    <h5 class="card-title">投稿日時：{{ $story->created_at }}</h5>
                    <p>ストーリー：{{App\Enums\StoryType::getDescription($story->story_type)}}</p>
                    <p class="card-text">内容：{{ $story->story }}</p>
                </div>
            </div>
        @endforeach
        </div>
    </div>
@endsection