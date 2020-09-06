@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="{{ route('company.companies.update', $company) }}" method="POST" enctype="multipart/form-data">
            {{csrf_field()}}
            {{method_field('PATCH')}}
                <div class="row form-group">
                    <div class="col-3">
                        <img src="{{ $company->image }}" alt="画像は未設定です。" class="mb-3" height="120" width="120">
                        <input type="file" class="form-control-file" id="image" name="image">
                    </div>
                    <div class="col-9">
                        <label>会社名</label>
                        <input type="text" class="form-control" value="{{ old('name', $company->name) }}" name="name">
                    </div>
                </div>
                <div class="form-group">
                    <label>Eメール</label>
                    <input type="text" class="form-control" value="{{ old('email', $company->email) }}" name="email" placeholder="メールアドレスを記入してください">
                </div>
                <div class="form-group">
                    <label>住所</label>
                    <input type="text" class="form-control" value="{{ old('address', $company->address) }}" name="address" placeholder="住所を記入してください">
                </div>
                <div class="form-group">
                    <label>会社紹介</label>
                    <textarea class="w-100" name="detail" rows="10" placeholder="会社紹介を記入してください">{{ old('detail', $company->detail) }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">更新する</button>
            </form>
        </div>
    </div>
</div>
@endsection