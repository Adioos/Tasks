@extends('layouts.app')
@section('title', 'Страница авторизации')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card mt-5">
                    <div class="card-body">
                        <h5 class="card-title">Войти в свой аккаунт</h5>
                        <form method="POST" action="">
                            {!! csrf_field() !!}
                            <div class="mb-3">
                                <label for="name">Имя пользователя:</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                                @if($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Пароль:</label>
                                <input type="password" class="form-control" id="password" name="password">
                                @if($errors->has('password'))
                                    <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                            <a href="{{ url('/') }}" class="btn btn-secondary">Главная страница</a>

                            <button type="submit" class="btn btn-primary">Войти</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
