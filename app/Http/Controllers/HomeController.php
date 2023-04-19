<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        //
    }

    public function index()
    {
        return view('home');
    }

//    public function profileUpdate(Request $request){
//        //validation rules
//
//        $request->validate([
//            'name' =>'required|min:4|string|max:255',
//            'email'=>'required|email|string|max:255',
//        ]);
//        $user =Auth::user();
//        $user->name = $request['name'];
//        $user->email = $request['email'];
//        $user->save();
//        return back()->with('message','Profile Updated');
//    }
}
