<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Cart;
use Illuminate\Http\Request;


class AdminController extends Controller
{
    public function confirm(Cart $cart){
        $cart->update([
            'status'=>'confirmed'
        ]);
        return back();
    }

    public function cart(){
        $shopsInCart = Cart::where('status', 'ordered')->with('shop', 'user')->get();
        return view('adm.cart', ['shopsInCart'=>$shopsInCart]);
    }

    public function showUsers(Request $request){
        $users = null;
        if($request->input('search')){
            $users = User::where ('name', 'LIKE', '%'.$request->input('search').'%')
                ->orWhere('email', 'LIKE', '%'.$request->input('search').'%')
            ->with('role')->get();
        }else{
            $users = User::with('role')->orderBy('email');
        }
    }
}
