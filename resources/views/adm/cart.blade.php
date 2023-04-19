@extends('layouts.adm')
@section('content')
    <table class="table">
        <thead class="thead-white">
        <tr>
            <th scope="col">#</th>
            <th scope="col">{{__('messages.Title:')}}</th>
            <th scope="col">{{__('messages.Name')}}</th>
            <th scope="col">{{__('messages.Choose material:')}}</th>
            <th scope="col">{{__('messages.SIZE:')}}</th>
            <th scope="col">{{__('messages.Sany:')}}</th>
            <th scope="col">{{__('messages.Status')}}</th>
            <th scope="col">#</th>
        </tr>
        </thead>
        <tbody>
            @for($i=1; $i<count($shopsInCart); $i++)
                <tr>
                    <th scope="row">{{$i}}</th>
                    <td>{{$shopsInCart[$i-1]->shop->title}}</td>
                    <td>{{$shopsInCart[$i-1]->user->name}}</td>
                    <td>{{$shopsInCart[$i-1]->material}}</td>
                    <td>{{$shopsInCart[$i-1]->size}}</td>
                    <td>{{$shopsInCart[$i-1]->number}}</td>
                    <td>{{$shopsInCart[$i-1]->status}}</td>
                    <td>
                        <form action="{{route('adm.cart.confirm', $shopsInCart[$i-1]->id)}}" method="post">
                            @csrf
                            @method('PUT')
                            <button class="btn btn-outline-dark" type="submit">{{__('messages.Confirm Order')}}</button>
                        </form>
                    </td>
                </tr>
             @endfor
        </tbody>
    </table>

@endsection
