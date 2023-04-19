@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <a class="btn btn-outline-dark" href="{{route('shops.index')}}">{{__('messages.Index Page')}}</a>

                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">{{__('messages.Title:')}}</th>
                        <th scope="col">{{__('messages.Choose material:')}}</th>
                        <th scope="col">{{__('messages.SIZE:')}}</th>
                        <th scope="col">{{__('messages.Sany:')}}</th>
                        <th scope="col">{{__('messages.Price:')}}</th>
                        <th scope="col">{{__('messages.Status')}}</th>
                        <th scope="col">#</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($shopsInCart as $shop)
                        <tr>
                            <td>{{$shop->title}}</td>
                            <td>{{$shop->pivot->material}}</td>
                            <td>{{$shop->pivot->size}}</td>
                            <td>{{$shop->pivot->number}}</td>
                            <td>{{$shop->price}}</td>
                            <td>{{$shop->pivot->status}}</td>
                            <td>
                                <a href="{{route('shops.undelete',$shop->id)}}" class="btn btn-danger">{{__('messages.Delete')}}</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <h4 class="fw-bold">
                    {{__('messages.All Summa:')}} {{$sum }} ₸
                </h4>
                <form  action="{{route('shops.buy', Auth::user()->id)}}" method="post">
                    @csrf
                    <button class="btn btn-outline-success mt-3" type="submit"
                        @if(Auth::user()->shot < $sum || $sum == 0) disabled @endif
                    >{{__('messages.BUY')}}</button>
                </form>
            </div>
        </div>
    </div>
@endsection
