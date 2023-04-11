<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function userRegister(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ], [
            'required' => 'Поле :attribute обязательно для заполнения.',
            'email' => 'Поле :attribute должно быть корректным email адресом.',
            'unique' => 'Пользователь с таким :attribute уже существует.',
            'min' => [
                'numeric' => 'Значение поля :attribute должно быть не меньше :min.',
                'string' => 'Поле :attribute должно содержать не менее :min символов.',
            ],
            'confirmed' => 'Подтверждение пароля не совпадает с паролем.',
        ], [
            'name' => 'Имя',
            'email' => 'электронный адрес',
            'password' => 'пароль',
        ]);

        $user = User::create([
            'email' => $validatedData['email'],
            'name' => $validatedData['name'],
            'password' => bcrypt($validatedData['password'])
        ]);
        Auth::loginUsingId($user->id);
        return redirect()->route('tasks.index');
    }


    public function userLogin(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|min:3',
            'password' => 'required|min:6',
        ], [
            'required' => 'Поле :attribute обязательно для заполнения.',
            'min' => [
                'string' => 'Поле :attribute должно содержать не менее :min символов.',
            ],
        ], [
            'name' => 'Имя',
            'password' => 'пароль'
        ]);

        if (!Auth::attempt($validatedData, $request->has('remember'))) {
            return back()->withErrors(['name' => 'Неправильный логин или пароль']);
        } else {
            return redirect()->route('tasks.index');
        }
    }


    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

}
