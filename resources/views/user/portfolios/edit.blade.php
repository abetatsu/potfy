@extends('layouts.user.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
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
                    <img src="{{ $portfolio->image_path }}" alt="画像" class="my-2">
                    <input type="file" class="form-control-file" id="image" name="image">
                </div>

                <div class="form-group">
                    <label for="exampleFormControlSelect1">開発言語</label>
                    <select class="form-control" id="exampleFormControlSelect1" name="technology">
                    <option>HTML CSS</option>
                    <option>JavaScript</option>
                    <option>PHP</option>
                    <option>Ruby</option>
                    <option>Python</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlSelect2">言語複数選択</label>
                    <select multiple class="form-control" id="exampleFormControlSelect2" name="technologies[]">  
                    @foreach ($technologies as $technology)
                    <option value="{{$technology->id}}">{{ $technology->name}}</option>
                    @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">更新する</button>
            </form>
        </div>
    </div>
</div>
@endsection