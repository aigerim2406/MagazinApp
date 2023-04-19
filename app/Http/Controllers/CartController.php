<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Shop;
use Illuminate\Support\Facades\Auth;


class CartController extends Controller
{
    public function buy(){
        $ids = Auth::user()->shopsWIthStatus('in_cart')->allRelatedIds();
        foreach($ids as $id){
            Auth::user()->shopsWithStatus('in_cart')->updateExistingPivot($id, ['status' => 'ordered']);
        }
        return back();
    }

    public function carts(){
        $shopsInCart = Auth::user()->shopsWithStatus('in_cart')->get();
        return view('cart.index', ['shopsInCart' => $shopsInCart]);
    }

    public function putToCart(Request $request, Shop $shop){
        $shopsInCart = Auth::user()->shopsWithStatus( 'in_cart')->where('shop_id', $shop->id)->first();

        if($shopsInCart != null)
            Auth::user()->shopsWithStatus('in_cart')->updateExistingPivot($shop->id,
            ['material' => $request->input('material'),
                'number' => $shopsInCart->pivot->number+$request->input('number'),
                'size' => $shopsInCart->pivot->number+$request->input('size')]);
        else
            Auth::user()->shopsWithstatus('in_cart')->attach($shop->id,
            ['material' => $request->input('material'),
                'number'=> $request->input('number'),
                'size' => $request->input('size')]);
    }

    public function deleteFromCart(Shop $shop){
        $shopsBought = Auth::user()->shopsWithStatus('in_cart')->where('shop_id', $shop->id)->first();

        if($shopsBought != null)
            Auth::user()->shopsWithStatus('in_cart')->detach($shop->id);
    }
}
