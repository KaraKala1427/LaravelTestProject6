@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-6 offset-md-3">
                            <a href="{{ route('login.name') }}" class="btn btn-danger btn-block">Зарегистрироваться с помощью Google</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
