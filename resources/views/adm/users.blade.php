@extends('layouts.adm')

@section('title', 'User Page')

@section('content')

    <form action="{{route('adm.users.search')}}" method="GET">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">@</span>
            </div>
            <input type="text" class="form-control" name="search" placeholder="..." aria-label="Username"
                   aria-describedby="basic-addon1">
            <button class="btn btn-success" type="submit">{{__('messages.Search')}}</button>
        </div>
    </form>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">{{__('messages.Name')}}</th>
            <th scope="col">{{__('messages.Email')}}</th>
            <th scope="col">{{__('messages.Role')}}</th>
            <th>###</th>
            <th>###</th>
        </tr>
        </thead>
        <tbody>
        @for($i = 0; $i<count($users); $i++)
            <tr>
                <th scope="row">{{$i+1}}</th>
                <td>{{$users[$i]->name}}</td>
                <td>{{$users[$i]->email}}</td>
                <td>{{$users[$i]->role->name}}</td>
                <td>
                    <form action="
                    @if($users[$i]->is_active)
                           {{route('adm.users.ban', $users[$i]->id)}}
                     @else
                           {{route('adm.users.unban', $users[$i]->id)}}
                    @endif" method="post">
                        @csrf
                        @method('PUT')
                        <button class="btn {{$users[$i]->is_active ? 'btn-danger' : 'btn-success'}} " type="submit">
                            @if($users[$i]->is_active)
                                {{__('messages.BAN')}}
                            @else
                                {{__('messages.UNBAN')}}
                            @endif
                        </button>
                    </form>
                </td>
                <td>
                    <a href="{{route('adm.users.edit',$users[$i]->id)}}" class="btn btn-outline-primary">{{__('messages.Edit')}}</a>
                </td>
            </tr>
        @endfor
        </tbody>
    </table>
@endsection
