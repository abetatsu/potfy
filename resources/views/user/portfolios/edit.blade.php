@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @include('layouts.flash-messages')
            <form action="{{ route('user.portfolios.update', $portfolio->id) }}" method="POST" enctype="multipart/form-data">
            {{csrf_field()}}
            {{method_field('PATCH')}}
                <div class="form-group">
                    <label>タイトル</label>
                    <input type="text" class="form-control" value="{{old('title', $portfolio->title)}}" name="title">
                </div>
                <div class="form-group">
                    <label>内容</label>
                    <textarea class="form-control" rows="5" name="description">{{old('description', $portfolio->description)}}</textarea>
                </div>
                <div class="form-group">
                    <label>リンク</label>
                    <input type="text" class="form-control" value="{{old('link', $portfolio->link)}}" name="link">
                </div>
                <div class="form-group">
                    <label for="image">変更前の画像</label><br>
                    <img src="{{ isset($portfolio->image_path) ? $portfolio->image_path : 'https://res.cloudinary.com/dlalfv68e/image/upload/v1598249615/v8ycx2qljsz6u4lzcosm.png' }}" alt="画像" class="my-2">
                    <input type="file" class="form-control-file" id="image" name="image">
                </div>
                <select-component
                    :technologies="{{ json_encode($technologies)}}"
                    :selected-techs="{{ json_encode($selectedTechs) }}"
                    :old-technologies="{{ json_encode(old('technologies')) }}"
                ></select-component>
                <button type="submit" class="btn bg-potfyYellow hover:bg-potfyYellowTitle text-white font-bold py-2 px-4 rounded-full">
                    更新する
                </button>
            </form>
        </div>
    </div>
</div>
@endsection