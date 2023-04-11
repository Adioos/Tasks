@extends('layouts.app')
@section('title', 'Личный кабинет')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Задача ID - {{ $task->id }}
                    </div>
                    <div class="card-body">
                        <h5 class="card-title mb-3">Название задачи - {{ $task->title }}</h5>
                        <p class="card-text mb-3">Описание задачи - {{ $task->description }}</p>
                        <p class="card-text mb-3">Статус задачи - {{ $task->status }}</p>
                        <p class="card-text mb-3">Дедлайн - {{ $task->deadline }}</p>
                        <p class="card-text mb-3">Дата создания - {{ $task->created_at->format('d-m-Y  H:i:s') }}</p>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-primary mr-3">Редактировать</a>
                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Вы уверены, что хотите удалить эту задачу?')">Удалить</button>
                        </form>
                        <a href="{{ route('tasks.index') }}" class="btn btn-secondary">К списку задач</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


