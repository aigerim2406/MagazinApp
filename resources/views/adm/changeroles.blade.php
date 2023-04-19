@extends('layouts.adm')

@section('title','ROLES PAGE')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <form action="{{route('adm.users.update',$users->id)}}" method="post">
                    @csrf
                    @method('PUT')
                    <select  class="form-control" id="selectInput" name="role_id">
                        @foreach($roles as $rname)
                            <option @if($rname->id==$users->role_id) selected @endif value="{{$rname->id}}">{{$rname->name}}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-primary">{{__('messages.Edit')}}</button>
                </form>
            </div>
        </div>
    </div>
@endsection



























{{--                <table class="table">--}}
{{--                    <thead>--}}
{{--                    <tr>--}}
{{--                        <th scope="col">#</th>--}}
{{--                        <th scope="col">Name</th>--}}
{{--                        <th scope="col">Email</th>--}}
{{--                        <th scope="col">Role</th>--}}
{{--                    </tr>--}}
{{--                    </thead>--}}
{{--                    <tbody>--}}
{{--                    @for($i=0; $i<count($users); $i++)--}}
{{--                        <tr>--}}
{{--                            <th scope="row">{{$i+1}}</th>--}}
{{--                            <td>{{$users[$i]->name}}</td>--}}
{{--                            <td>{{$users[$i]->email}}</td>--}}
{{--                            <td>--}}

{{--                            </td>--}}
{{--                        </tr>--}}
{{--                    @endfor--}}
{{--                    </tbody>--}}
{{--                </table>--}}
