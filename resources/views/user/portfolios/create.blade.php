@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @include('layouts.flash-messages')
            <form action="{{ route('user.portfolios.store') }}" method="POST" enctype="multipart/form-data">
            {{csrf_field()}}
                <div class="form-group">
                    <label>タイトル</label>
                    <input type="text" class="form-control"  value="{{old('title')}}" placeholder="タイトルを入力して下さい" name="title">
                </div>
                <div class="form-group">
                    <label>内容</label>
                    <textarea class="form-control" placeholder="内容" rows="5" name="description">{{old('description')}}</textarea>
                </div>
                <div class="form-group">
                <label>リンク</label>
                    <input type="text" class="form-control" placeholder="リンク先を入力して下さい" value="{{old('link')}}" name="link">
                </div>
                <div class="form-group">
                    <label for="image">画像</label>
                    <input type="file" class="form-control-file" id="image" name="image">
                </div>
                <select-component
                    :technologies="{{ json_encode($technologies)}}"
                    :old-technologies="{{ json_encode(old('technologies')) }}"
                ></select-component>
                <button type="submit" class="bg-potfyYellow hover:bg-potfyYellowTitle text-white font-bold py-2 px-4 rounded-full">
                    作成する
                </button>
            </form>
        </div>
    </div>
</div>
@endsection