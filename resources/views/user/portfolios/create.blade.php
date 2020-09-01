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
            <form action="{{ route('user.portfolios.store') }}" method="POST" enctype="multipart/form-data">
            {{csrf_field()}}
                <div class="form-group">
                    <label>タイトル</label>
                    <input type="text" class="form-control"  value="{{old('title')}}" placeholder="タイトルを入力して下さい" name="title" >
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
                <div class="form-group">
                    <label for="exampleFormControlSelect2">言語複数選択</label>
                    <select multiple class="form-control" id="exampleFormControlSelect2" name="technologies[]">  
                    @foreach ($technologies as $technology)
                    <option value="{{$technology->id}}">{{ $technology->name}}</option>
                    @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">作成する</button>
            </form>
        </div>
    </div>
</div>
@endsection