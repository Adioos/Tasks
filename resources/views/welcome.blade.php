@extends('layouts.app')
@section('title', 'Главная страница')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card mt-5">
                    <div class="card-body">
                        <h1 class="card-title text-center">Добро пожаловать!</h1>
                        <h4>Это приложение - простой веб-сервис для управления задачами. Оно позволяет пользователям
                            зарегистрироваться, войти в систему и создавать, редактировать и удалять свои задачи.
                            Пользователи могут видеть список своих задач на странице профиля и управлять ими, а также
                            добавлять новые задачи.
                            Приложение также использует систему аутентификации и авторизации, которая обеспечивает
                            безопасность пользовательских данных. Все задачи пользователя сохраняются в базе данных и
                            отображаются только для него, что обеспечивает конфиденциальность и безопасность.
                            Такое приложение может быть полезным для индивидуальных пользователей или небольших групп,
                            которые хотят управлять своими задачами и контролировать их выполнение.</h4>
                        <h4 class="card-text mt-4 text-center mb-3 ">Пожалуйста, выберите действие:</h4>
                        @guest
                            <a href="{{ route('login') }}" class="btn btn-primary d-block mb-3 col-3 mx-auto">Авторизация</a>
                            <a href="{{ route('register') }}" class="btn btn-secondary d-block col-3 mx-auto">Регистрация</a>
                        @else
                            <a href="{{ route('tasks.index') }}" class="btn btn-secondary d-block col-3 mx-auto mb-3">Личный кабинет</a>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger d-block col-3 mx-auto"><a href="{{ route('logout') }}"></a>Выйти
                                    из профиля
                                </button>
                            </form>
                        @endguest
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

