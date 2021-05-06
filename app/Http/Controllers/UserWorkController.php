<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
class UserWorkController extends Controller
{
    public function MainPage(){

        if(!Auth::check()){
            return redirect(route('main'));
        }

        return view("pages.user");
    }

    public function AddMsg(Request $rec){

        if(!Auth::check()){

                return response()->json([
                    'state' => 'redirect',
                    'url' => route('main')
                  ]);

        }

        $user=Auth::user();
        $dLastSend=strtotime($user->lastSend);
        $now=strtotime("+0");
        if($dLastSend>$now){
            return response()->json([
                'state' => 'redirect',
                'url' => route('user')
              ]);
        }

        $msgs = array(
            'title.required' => 'Вы не ввели тему сообщения',
            'title.max' => 'Тема сообщения длиннее 255',
            'msg.required' => 'Вы не ввели текст сообщения',
            'msg.min' => 'Минимальная длинна сообщения 10 ',
        );
        $valid = Validator::make($rec->all(), [
            'title' => 'required|max:255',
            'msg' => 'required',
        ],$msgs);

        if ($valid->fails()) {
            return response()->json([
                'state' => 'msgerror',
                'errors' => $valid->errors()->first()
              ]);

        }

        $file="";
        if($rec->hasFile('file')){
            $f=$rec->file('file');
            $f->move('uploads',$user->login.'_'.$f->getClientOriginalName());
            $file=$user->login.'_'.$f->getClientOriginalName();
               die($f->getClientOriginalName());
        }

        // тут  добавляем в бд

    }


}
