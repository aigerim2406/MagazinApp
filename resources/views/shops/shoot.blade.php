@extends('layouts.app')
@section('title','ADS PAGE')
@section('content')

    <div class="container">
        <a class="btn btn-outline-dark" href="{{route('shops.index')}}">{{__('messages.Index Page')}}</a>
        <hr>
        <form action="{{route('shops.addMoney', Auth::user()->id)}}" method="post">
            @csrf
            <img src="https://resources.cdn-kaspi.kz/guide/content/kkz/images/Products_Mobile_Icons/ru/gold.png" style="width: 150px ; height: 50px">
            <input type="number" name="shot" class="form-control" style="width: 250px" placeholder="{{__('messages.money')}}">
            <br>
            <hr>
            <button type="submit" class="btn btn-outline-secondary">{{__('messages.Shot')}}</button>
        </form>
    </div>
@endsection
