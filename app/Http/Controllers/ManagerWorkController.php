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

        $rows=Msges::orderBy('id', 'desc')->paginate(2);


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
