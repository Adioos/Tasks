@extends('layouts.app')
@section('title', 'Создание задачи')
@section('content')
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Добавление задачи</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('tasks.store') }}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="title">Название задачи</label>
                                <input type="text" name="title" id="title" class="form-control" required>
                                @error('title')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="description">Описание задачи</label>
                                <textarea name="description" id="description" rows="5" class="form-control" required></textarea>
                                @error('description')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="status">Статус задачи</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="pending">Ожидание</option>
                                    <option value="in_progress">В работе</option>
                                    <option value="resolved">Решено</option>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="deadline">Дедлайн</label>
                                <input type="datetime-local" name="deadline" id="deadline" class="form-control">
                            </div>
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-primary">Добавить задачу</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


