@extends('layouts.app')
@section('title', 'EDIT PAGE')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <form action="{{route('comments.update',$comment->id)}}" method="post">
                        @csrf
                        @method('PUT')
                        <div>
                            <br>
                            <textarea name="content" id="" cols="30" rows="10">{{$comment->content}}</textarea>
                            <br>
                            <button type="submit">Update</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
