<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //

    public function login(Request $rec)
    {
        $msgs = array(
            'login.required' => 'Вы не ввели логин',
            'password.required' => 'Вы не ввели пароль',
        );

        $valid = Validator::make($rec->all(), [
            'login' => 'required|max:64',
            'password' => 'required',
        ], $msgs);

        if ($valid->fails()) {
            return response()->json([
                'state' => 'logerror',
                'errors' => $valid->errors()->first()
            ]);
        }


        if (Auth::attempt(['login' => $rec->login, 'password' => $rec->password])) {
            $user = Auth::user();
            $redirectURL = [route('user'), route('manager')];
            return response()->json([
                'state' => 'logok',
                'url' => $redirectURL[$user->role]
            ]);
        }

        return response()->json([
            'state' => 'logerror',
            'errors' => 'Неверный логин или пароль'
        ]);
    }

    public function Reg(Request $rec)
    {



        $msgs = array(
            'login.required' => 'Вы не ввели логин',
            'mail.required' => 'Вы не ввели email',
            'password1.required' => 'Вы не ввели пароль',
            'password2.required' => 'Вы не ввели подтверждеия пароля',
            'password2.same' => 'Пароли не совпадают',
        );


        $valid = Validator::make($rec->all(), [
            'login' => 'required|string|max:255|min:5|regex:/^[a-z]+$/i|unique:users',
            'mail' => 'required|email|min:6',
            'password1' => 'required|min:6',
            'password2' => 'required|min:6|same:password1',
        ], $msgs);
        if ($valid->fails()) {
            return response()->json([
                'state' => 'regerror',
                'errors' => $valid->errors()->first()
            ]);
        }

        $user = User::create(['login' => $rec->login, 'password' => Hash::make($rec->password1), 'email' => $rec->mail, 'role' => 0, 'lastSend' => '2021-01-01']);
        Auth::login($user);
        if ($user) {
            Auth::login($user);
            return response()->json([
                'state' => 'regok',
                'url' => route('user')
            ]);
        }

        return response()->json([
            'state' => 'regerror',
            'errors' => ['Ошибка регистрации']
        ]);
    }
    public function LogOut()
    {
        Auth::logout();
        return redirect(route('main'));
    }
}
