<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/register', function () {
    return view('register');
})->name('register');
Route::post('/register', 'App\Http\Controllers\AuthController@userRegister');

Route::middleware('guest')->group(function () {
    Route::get('/login', function () {
        return view('login');
    })->name('login');
    Route::post('/login', 'App\Http\Controllers\AuthController@userLogin');
});

Route::post('/logout', 'App\Http\Controllers\AuthController@logout')->name('logout');


// маршрут для отображения списка задач
Route::get('/tasks', [App\Http\Controllers\TaskController::class, 'index'])->name('tasks.index');
// маршрут для отображения формы создания задачи
Route::get('/tasks/create', [App\Http\Controllers\TaskController::class, 'create'])->name('tasks.create');
// маршрут для создания задачи
Route::post('/tasks', [App\Http\Controllers\TaskController::class, 'store'])->name('tasks.store');
// маршрут для отображения конкретной задачи
Route::get('/tasks/{id}', [App\Http\Controllers\TaskController::class, 'show'])->name('tasks.show');
// маршрут для отображения формы редактирования задачи
Route::get('/tasks/{id}/edit', [App\Http\Controllers\TaskController::class, 'edit'])->name('tasks.edit');
// маршрут для обновления задачи
Route::put('/tasks/{id}', [App\Http\Controllers\TaskController::class, 'update'])->name('tasks.update');
// маршрут для удаления задачи
Route::delete('/tasks/{id}', [App\Http\Controllers\TaskController::class, 'destroy'])->name('tasks.destroy');
// маршрут для поиска задачи
Route::get('/search', [App\Http\Controllers\TaskController::class, 'search'])->name('tasks.search');




