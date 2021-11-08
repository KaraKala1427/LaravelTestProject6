@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-6 offset-md-3">
                            <a href="{{route('login.google')}}" class="btn btn-primary btn-block">Войти с помощью Google</a>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6 offset-md-3">
                            <a href="{{ route('register') }}" class="btn btn-danger btn-block">Зарегистрироваться с помощью Google</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
