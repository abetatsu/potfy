@extends('layouts.app')

@section('content')
<section class="container py-4 my-5 bg-white text-center">
    <div class="row my-4 text-muted col-md-9 mx-auto">
      <h2 class="h5 col-12">運営チーム</h2>
    </div>

    <div class="row my-4 text-muted col-md-9 mx-auto">
      <p class="line-height-2 col-md-12"><strong>開発メンバー</strong><br>
        @foreach($devMembers as $devMember)
          - <a class="my-2 d-inline-block" href="https://github.com/{{ $devMember }}">{{ $devMember }}</a><br>
        @endforeach
      </p>
    </div>

    <div class="row my-4 text-muted col-md-9 mx-auto">
      <p class="line-height-2 col-md-12"><strong>サポートメンバー</strong><br>
        @foreach($sprtMembers as $sprtMember)
          - <a class="my-2 d-inline-block" href="https://github.com/{{ $sprtMember }}">{{ $sprtMember }}</a><br>
        @endforeach
      </p>
    </div>

    <div class="row my-4 text-muted col-md-9 mx-auto">
      <p class="line-height-2 col-md-12"><strong>スペシャルサンクス</strong><br>
        @foreach($thxMembers as $thxMember)
          - <a class="my-2 d-inline-block" href="https://twitter.com/{{ $thxMember }}">{{ $thxMember }}</a><br>
        @endforeach
      </p>
    </div>
</section>
@endsection
