<?php

namespace App\Http\Controllers\Auth2;

use App\Http\Controllers\Controller;
use App\Models\Shop;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function create(){
        return view('auth.register');
    }

    public function register(Request $request){
        $validated=$request->validate([
            'name'=>'required|string|max:255',
            'email'=>'required|email|max:255|unique:users',
            'password'=>'required|min:6|confirmed',
            'image' => 'required|image|mimes:png,jpg,jpeg,gif,svg,webp'
        ]);

        $fileName = time().$request->file('image')->getClientOriginalName();
        $image_path = $request->file('image')->storeAs('image',$fileName, 'public');
        //kandai fail koldanganyn korsetpeu klientke

        $user=User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'image' =>'/storage/'.$image_path,
        ]);

        Auth::login($user);

        return redirect()->route('shops.index');
    }

    public function updateregister(User $user)
    {
        return view('shops.editprofile', ['user' => $user]);
    }
        public function editprofile(Request $request,User $user){
            $request->validate([
                'image' => 'required|image',
                'email' => 'required',
                'name' => 'required'
            ]);
            $fileName = time().$request->file('image')->getClientOriginalName();
            $image_path = $request->file('image')->storeAs('images',$fileName,'public');
            $user->update([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'image'=>'/storage/'.$image_path,
            ]);
            return redirect()->route('shop.user')->with('message',(__('messages.updateregister')));
        }
}
