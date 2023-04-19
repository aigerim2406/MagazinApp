<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Shop;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function createCooment(Request $request){
        Comment::create([
            'content' => $request->input('content'),
            'shop_id' => $request->input('shop_id')
        ]);
        return redirect()->route('shops.show', $request->input('shop_id'));
    }

    public function store(Request $request){
        $validated =$request->validate([
            'content' => 'required',
            'shop_id' => 'required|numeric|exists:shops,id'
        ]);

        Auth::user()->comments()->create($validated);
        return back()->with('message', (__('messages.createComment')));
    }

    public function destroy(Comment $comment){
        $this->authorize('delete', $comment);
        $comment->delete();
        return back()->with('message', (__('messages.destroyed')));
    }
}
