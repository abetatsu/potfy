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
            <form action="{{ route('user.portfolios.update', $portfolio->id) }}" method="POST">
            {{csrf_field()}}
            {{method_field('PATCH')}}
                <div class="form-group">
                    <label>タイトル</label>
                    <input type="text" class="form-control" value="{{ $portfolio->title }}" name="title">
                </div>
                <div class="form-group">
                    <label>内容</label>
                    <textarea class="form-control" rows="5" name="description">{{ $portfolio->description }}</textarea>
                </div>
                <div class="form-group">
                    <label>リンク</label>
                    <input type="text" class="form-control" value="{{ $portfolio->link }}" name="link">
                </div>
                
                <button type="submit" class="btn btn-primary">更新する</button>
            </form>
        </div>
    </div>
</div>
@endsection