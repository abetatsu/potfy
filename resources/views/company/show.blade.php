@extends('layouts.company.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-header">
                <h5>会社名：{{ $company->name }}</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6 ml-3">
                        <img src="{{ $company->image }}" alt="画像は未設定です。" class="mb-3" height="120" width="120">
                        <p class="card-text">Eメール：{{ $company->email }}</p>
                        <p class="card-text">住所：{{ $company->address }}</p>
                        <p class="card-text">会社紹介：{{ $company->detail }}</p>
                        <a href="{{route('company.companies.edit', $company)}}" class="btn btn-primary mt-3">編集する</a>
                    </div>
                    <div class="col-4">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection