<?php

namespace App\Http\Controllers;

use App\Msges;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class ManagerWorkController extends Controller
{


    Public function MainPage(){
        if(!Auth::check()){
            return redirect(route('main'));
        }
        $user=Auth::user();
        if($user->role==0){
            return redirect(route('user'));
        }

       // $rows=Msges::leftjoin('Users', 'Msges.user', '=', 'Users.login')->orderBy('id', 'desc')->paginate(10);
$rows=Msges::leftjoin('Users', 'Msges.user', '=', 'Users.login')->select([
    'Msges.id as id',
    'Msges.user as user',
    'Users.email as email',
    'Msges.title as title',
    'Msges.msg as msg',
    'Msges.file as file',
    'Msges.readed as readed',
    'Msges.created_at as created_at',
])->orderBy('id', 'desc')->paginate(10);



        return view("pages.manager")->with('MSGS', $rows);

    }


    public function Readed(Request $rec){
        $ritem=Msges::find($rec->id);
        if($ritem){
             $ritem->readed=1;
             $ritem->save();
             return response()->json([
                 'state' => 'readok',
                 'id' => $rec->id
             ]);
        }

    }


}
