@extends('layouts.app')
@section('title', 'Создание задачи')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Редактировать задачу</div>
                    <div class="card-body">
                        <form action="{{ route('tasks.update', $task->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group row">
                                <label for="title" class="col-md-4 col-form-label text-md-right mb-3">Название
                                    задачи</label>
                                <div class="col-md-6">
                                    <input id="title" type="text"
                                           class="form-control @error('name') is-invalid @enderror" name="title"
                                           value="{{ old('title', $task->title) }}" required autocomplete="name"
                                           autofocus>
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label for="description" class="col-md-4 col-form-label text-md-right">Описание
                                    задачи</label>
                                <div class="col-md-6">
                                    <textarea id="description"
                                              class="form-control @error('description') is-invalid @enderror"
                                              name="description" rows="5"
                                              required>{{ old('description', $task->description) }}</textarea>
                                    @error('description')
                                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label for="deadline" class="col-md-4 col-form-label text-md-right">Дедлайн</label>
                                <div class="col-md-6">
                                    <input type="datetime-local" name="deadline" id="deadline" class="form-control"
                                           value="{{ $task->deadline ? \Carbon\Carbon::parse($task->deadline)->format('Y-m-d\TH:i') : '' }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="status" class="col-md-4 col-form-label text-md-right mb-3">Статус
                                    задачи</label>
                                <div class="col-md-6">
                                    <select name="status" id="status" class="form-control">
                                        <option value="pending" {{ $task->status == 'pending' ? 'selected' : '' }}>
                                            Ожидание
                                        </option>
                                        <option
                                            value="in_progress" {{ $task->status == 'in_progress' ? 'selected' : '' }}>В
                                            работе
                                        </option>
                                        <option value="resolved" {{ $task->status == 'resolved' ? 'selected' : '' }}>
                                            Решено
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">Сохранить</button>
                                    <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Отмена</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


