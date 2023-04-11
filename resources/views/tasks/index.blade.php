@extends('layouts.app')
@section('title', 'Личный кабинет')
@section('content')
    <div class="container">
        <h4>
            Поиск задач
        </h4>
        <form class="d-flex mb-3" role="search" action="{{ route('tasks.search') }}" method="GET">
            <input class="form-control me-2" type="search" placeholder="Найти задачу" aria-label="Search" name="search"
                   value="{{ request('search') }}">
            <button class="btn btn-outline-success" type="submit">Поиск</button>
        </form>
        <div class="container mt-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-flex justify-content-between mb-3 align-items-center">
                        @if(isset($search))
                            <h2>Результат поиска: {{ $search }}</h2>
                        @else
                            <h1>Список задач</h1>
                        @endif
                        <div>
                            <a href="{{ route('tasks.create') }}" class="btn btn-primary ">Добавить задачу</a>
                        </div>
                    </div>
                    @if(count($tasks) > 0)
                        <table class="table table-striped table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Название задачи</th>
                                <th>Описание задачи</th>
                                <th>Дедлайн</th>
                                <th>
                                    Статус задачи
                                </th>
                                <th>Действия</th>
                            </tr>
                            </thead>
                            <thead>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th>
                                    <form action="{{ route('tasks.index') }}" method="get">
                                        <select name="deadline" onchange="this.form.submit()">
                                            <option value=""{{ request('deadline') == '' ? ' selected' : '' }}>Все</option>
                                            <option value="asc_deadline"{{ request('deadline') == 'asc_deadline' ? ' selected' : '' }}>По возрастанию</option>
                                            <option value="desc_deadline"{{ request('deadline') == 'desc_deadline' ? ' selected' : '' }}>По убыванию</option>
                                            <option value="no_deadline"{{ request('deadline') == 'no_deadline' ? ' selected' : '' }}>Не определено</option>
                                        </select>
                                    </form>
                                </th>
                                <th>
                                    <form action="{{ route('tasks.index') }}" method="get">
                                        <select name="status" onchange="this.form.submit()">
                                            <option value="">Все</option>
                                            <option
                                                value="resolved"{{ request('status') == 'resolved' ? ' selected' : '' }}>
                                                Решено
                                            </option>
                                            <option
                                                value="in_progress"{{ request('status') == 'in_progress' ? ' selected' : '' }}>
                                                В работе
                                            </option>
                                            <option
                                                value="pending"{{ request('status') == 'pending' ? ' selected' : '' }}>
                                                Ожидание
                                            </option>
                                        </select>
                                    </form>
                                </th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tasks as $task)
                                <tr>
                                    <td>{{ $task->id }}</td>
                                    <td>{!! str_replace($search, '<span>'.$search.'</span>', $task->title) !!}</td>
                                    @if (!empty($search))
                                        <td>{!! str_replace($search, '<span>'.$search.'</span>', $task->description) !!}</td>
                                    @else
                                        <td>{!! str_replace($search, '<span>'.$search.'</span>', \Illuminate\Support\Str::limit($task->description, 40)) !!}</td>
                                    @endif
                                    <td class="{{ \Carbon\Carbon::parse($task->deadline)->lte(\Carbon\Carbon::today()) && !\Carbon\Carbon::parse($task->deadline)->isToday() ? 'text-decoration-line-through' : '' }}">
                                        @if ($task->deadline)
                                            {{ \Carbon\Carbon::parse($task->deadline)->format('d-m-Y') }}
                                            @if (\Carbon\Carbon::parse($task->deadline)->diffInHours(now()) < 24)
                                                <i class="fa-solid fa-fire mod" style="color: #ff0000;"
                                                   title="Горит жопа!"></i>
                                            @endif
                                        @else
                                            Не определен
                                        @endif
                                    </td>
                                    <td class="{{ $task->status == 'Решено' ? 'text-success' : ($task->status == 'В работе' ? 'text-warning' : 'text-danger') }}">{{ $task->status }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-secondary dropdown-toggle" type="button"
                                                    id="taskActions_{{ $task->id }}" data-bs-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">
                                                Действия
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="taskActions_{{ $task->id }}">
                                                <a class="dropdown-item" href="{{ route('tasks.show', $task->id) }}">Просмотр</a>
                                                <a class="dropdown-item" href="{{ route('tasks.edit', $task->id) }}">Редактировать</a>
                                                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST"
                                                      class="d-inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item"
                                                            onclick="return confirm('Вы уверены, что хотите удалить эту задачу?')">
                                                        Удалить
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center mb-5">
                            {{ $tasks->links('pagination::bootstrap-4') }}
                        </div>
                    @else
                        <h4>Список задач пуст.</h4>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection


