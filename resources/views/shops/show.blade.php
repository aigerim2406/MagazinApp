@extends('layouts.app')
@section('title', 'SHOW PAGE')
@section('content')

    <header class="bg-secondary py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder">{{__('messages.Shop in style')}}</h1>
                <p class="lead fw-normal text-white-50 mb-0">{{__('messages.Shop jewelry - your special stories')}}</p>
            </div>
        </div>
    </header>

    <div class="card mb-3" style="max-width: 1600px;">
        <div class="row g-0">
            <br><br>
            <div class="d-flex">
                <a class="btn btn-outline-dark" href="{{route('shops.index')}}">{{__('messages.Index Page')}}</a>

                @can('update', $shop)
                    <a class="btn btn-outline-dark" href="{{route('shops.edit',$shop->id)}}"
                    >{{__('messages.Edit')}}</a>
                @endcan
            </div>
            <hr>
            <div class="col-md-6">
                <img src="{{$shop->image}}" style="height: 450px; width: 450px">
                <br><br>
                <form action="{{route('comments.store')}}" method="post">
                    @csrf
                    {{__('messages.Reviews:')}}<br> <textarea name="content" rows=""3></textarea>
                    <input type="hidden"class="form-control" name="shop_id" value="{{$shop->id}}">
                    <button type="submit" class="btn btn-outline-dark">{{__('messages.Save')}}</button>
                </form>

                <hr>

                @foreach($shop->comments as $comment)
                    <p>{{$comment->content}}</p>
                    <small>{{$comment->created_at}} | Author: {{$comment->user->name}}</small>
                    @can('delete', $comment)
                        <form action="{{route('comments.destroy', $comment->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-success"> Delete </button>
                        </form>
                    @endcan
                @endforeach
            </div>

            <div class="col-md-6">
                <div class="card-body">
                    <form action="{{route('shops.cart',$shop->id)}}" method="post" class="form-inline">
                        @csrf
                        <div class="card-body">
                            <h2 class="card-title display-5">{{$shop->title}}</h2>
                            <h3 class="display-7"><span class="badge bg-secondary">{{$shop->price}} ₸</span></h3>                            <hr>
                            {{__('messages.SIZE:')}}
                            <select class="form-select" name="size">
                                @for($i=10; $i<=30; $i++)
                                    <option value="{{$i}}">{{$i}}</option>
                                @endfor
                            </select>
                            <br>
                            <hr>
                            {{__('messages.Choose material:')}}
                            <select name="material">--}}
                                <option value="brilliant">Brilliant</option>
                                <option value="golden">Golden</option>
                                <option value="silver">Silver</option>
                            </select>
                            <br><br>
                            <hr>
                            {{__('messages.Sany:')}} <input class="input-text qty" type="number" name="number" placeholder="1">
                            <br>
                            <hr>
                            <button type="submit" class="btn btn-outline-success" style="margin-bottom: 0.9rem;">{{__('messages.Add to Cart')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


