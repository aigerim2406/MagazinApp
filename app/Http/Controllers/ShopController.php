<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Shop;
use App\Models\User;

class ShopController extends Controller
{
    public function buy( User $user){
        $ids = Auth::user()->shopsWIthStatus('in_cart')->allRelatedIds();
        $rtcart = Auth::user()->shopsWIthStatus('in_cart')->get();
        $sum = 0;
        foreach($rtcart as $rt){
            $sum += $rt->price * $rt->pivot->number;
        }

        $user->update([
            'shot' => Auth::user()->shot - $sum
        ]);

        foreach($ids as $id){
            Auth::user()->shopsWithStatus('in_cart')->updateExistingPivot($id, ['status' => 'ordered']);
        }
        return back()->with('message', (__('messages.buy')));
    }

    public function carts(){
        $shopsInCart = Auth::user()->shopsWithStatus('in_cart')->get();
        $sum = 0;
        foreach ($shopsInCart as $ic){
            $sum += $ic->price * $ic->pivot->number;
        }

        return view('shops.carts', ['shopsInCart' => $shopsInCart, 'sum' => $sum]);
    }

    public function cart(Request $request, Shop $shop){
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

        return back()->with('message', (__('messages.cart')));
    }

    public function undelete(Shop $shop){

        $shopsBought = Auth::user()->shopsWithStatus('in_cart')->where('shop_id', $shop->id)->first();

        if($shopsBought != null)
            Auth::user()->shopsWithStatus('in_cart')->detach($shop->id);

        return back()->with('message', (__('messages.undelete')));
    }

    public function shopsByCategory(Category $category)
    {
        $shops = $category->shops;

        return view('shops.index', ['shops' => $shops, 'categories' => Category::all()]);
    }

    public function index(){
        return view('shops.index', ['shops' => Shop::all(), 'categories' => Category::all()]);
    }

    public function create(){
        $this->authorize('create', Shop::class);
        return view('shops.create', ['categories' => Category::all()]);
    }

    public function show(Shop $shop)
    {
        return view('shops.show', ['shop' => $shop]);
    }


    public function edit(Shop $shop)
    {
        return view('shops.edit', ['shop' => $shop, 'categories' => Category::all()]);
    }

    public function destroy(Shop $shop)
    {
        $this->authorize('delete', $shop);
        $shop->delete();
        return redirect()->route('shops.index')->with('message', (__('messages.destroy')));
    }

    public function store(Request $request){
        $validated =$request->validate([
            'title' => 'required|max:255',
            'price' => 'required|numeric',
            'category_id' => 'required|numeric',
            'image' => 'required|image|mimes:png,jpg,jpeg,gif,svg,webp|max:2048|dimensions:min_width=100,min_height=100,max_width=20000,max_height=2000'
        ]);

        $fileName = time().$request->file('image')->getClientOriginalName();
        $image_path = $request->file('image')->storeAs('shops', $fileName, 'public');
        $validated['image'] = '/storage/'.$image_path;

        Auth::user()->shops()->create($validated);

        return redirect()->route('shops.index')->with('message', (__('messages.created')));
    }

    public function update(Request $request, Shop $shop)
    {
        $request->validate([
            'title' => 'required|max:255',
            'price' => 'required|numeric',
            'category_id' => 'required|numeric',
            'image' => 'required|image',
        ]);
        $shop->update([
            'title' => $request->input('title'),
            'image' => $request->input('image'),
            'price' => $request->input('price'),
            'category_id' => $request->input('category_id')
        ]);
        return redirect()->route('shops.index')->with('message', (__('messages.updated')));
    }

    public function office(){
        return view('shops.profile');
    }

}














//public function search(Request $request){
//    $search = $request->input('search');
//
//    $shops = Shop::query()->where('title', 'LIKE', "%{$search}%")->get();
//
//    return view('shops.index', compact('shops'));
//}
