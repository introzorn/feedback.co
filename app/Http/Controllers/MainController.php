<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class MainController extends Controller
{
    //

    public function MainPage(){
        if(Auth::check()){
            $user=Auth::user();
            $redirectURL=['/user','/manager'];
            return redirect($redirectURL[$user->role]);
        }
        return view('pages.main');

    }
}
