<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class AuthController extends Controller
{
    //

    public function login(Request $rec){
        $validator = Validator::make($rec->all(), [
            'login' => 'required|max:64',
            'password' => 'required',
        ]);


    }
    public function Reg(Request $rec){
        $valid = Validator::make($rec->all(), [
            'login'=>'required|string|max:255|min:5|regex:/^[a-z]+$/i|unique:users',
            'mail'=>'required|email|min:6',
            'password1'=>'required|min:6',
            'password2' => 'required|min:6|same:password',
        ]);
        if ($valid->fails()) {
            return response()->json([
                'state' => 'loginerror',
                'errors' => $valid->errors()->all()
              ]);

        }

    }

}
