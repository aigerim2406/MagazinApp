@extends('layouts.adm')
@section('title', 'Comments Page')
@section('content')
    <table class="table mt-auto">
        <thead>
            <tr>
                <th scope="col">{{__('messages.Reviews:')}}</th>
                <th scope="col">{{__('messages.Delete')}}</th>
            </tr>

            @foreach($comment as $com)
                <tr>
                    <td>
                        <p>{{$com->content}}</p>
                    </td>
                    <td>
                        <form action="{{route('comments.destroy', $com->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-dark">{{__('messages.Delete')}}</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </thead>
    </table>
@endsection
