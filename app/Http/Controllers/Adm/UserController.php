<?php

namespace App\Http\Controllers\Adm;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Shop;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
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


    public function index(Request $request){
        $users = null;
        if($request->search) {
            $users = User::where('name', 'LIKE', '%'.$request->search.'%')
            ->orWhere('email','LIKE', '%'.$request->search.'%' )
            ->with('role')->get();
        }
        else {
            $users = User::with('role')->get();
        }
            return view('adm.users', ['users' => $users]);
    }

    public function ban(User $user){
        $user->update([
            'is_active' => false,
        ]);
        return back();
    }

    public function unban(User $user){
        $user->update([
            'is_active' => true,
        ]);
        return back();
    }

    public function edit(User $user)
    {
        return view('adm.changeroles',['users'=>$user,'roles' => Role::all()]);
    }

    public function update(Request $request,User $user){
        $validated=$request->validate([
            'role_id'=>'required|numeric|exists:roles,id',
        ]);

        $user->update([
            'role_id' => $request->input('role_id'),
        ]);

        return redirect(route('adm.users.index'));
    }

    public function create(){
        return view('adm.create');
    }

    public function show(){
        return view('adm.show',['users'=>Category::all()]);
    }

    public function store(Request $request){
        $validated = $request->validate([
            'name' => 'required|max:255',
            'name_en' => 'required|max:255',
            'name_kz' => 'required|max:255',
            'name_ru' => 'required|max:255',
            'code' => 'required|max:255',
        ]);
        Category::create($validated);
        return redirect()->route('adm.categories.show');
    }

    public function comments(Comment $comment){
        return view('adm.comments',['comment'=>Comment::all()]);
    }

    public function shot(){
        return view('shops.shoot');
    }

    public function addMoney(Request $request, User $user){
        $user->update([
           'shot' => Auth::user()->shot + $request->input('shot')
        ]);
        return redirect()->route('shops.index')->with('message', (__('messages.added')));
    }
}
