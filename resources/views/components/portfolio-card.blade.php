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