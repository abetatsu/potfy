@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10 text-center">
            <p class="text-lg font-bold mb-3">投稿一覧</p>
            @include('layouts.flash-messages')
            <div class="row mb-3">
                @foreach ($portfolios as $portfolio)
                    @include('components.portfolio-card')
                @endforeach
            </div>
            <div class="row justify-center">
                {{ $portfolios->links() }}
            </div>
        </div>
    </div>
    </div>
</div>
@endsection