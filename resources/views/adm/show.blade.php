@extends('layouts.adm')

@section('title','Category page')

@section('content')
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">{{__('messages.Name')}}</th>
            <th scope="col">{{ __('messages.Namekz') }}</th>
            <th scope="col">{{__('messages.Nameru')}}</th>
            <th scope="col">{{__('messages.Nameen')}}</th>
            <th scope="col">{{__('messages.Code')}}</th>
        </tr>
        </thead>
        <tbody>
            @for($i = 0;$i<count($users);$i++)
                <tr>
                    <th scope="row">{{$i+1}}</th>
                    <td>{{$users[$i]->name}}</td>
                    <td>{{$users[$i]->name_kz}}</td>
                    <td>{{$users[$i]->name_ru}}</td>
                    <td>{{$users[$i]->name_en}}</td>
                    <td>{{$users[$i]->code}}</td>
                </tr>
            @endfor
        </tbody>
    </table>
    <a class="btn btn-success" href="{{route('adm.categories.create')}}">{{__('messages.Create category')}}</a>
@endsection
