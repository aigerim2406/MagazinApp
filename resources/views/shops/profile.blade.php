@extends('layouts.app')
@section('title','My profile')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 mb-4 mb-sm-5">
                <div class="card card-style1 border-0">
                    <div class="card-body p-1-9 p-sm-2-3 p-md-6 p-lg-7">
                        <div class="row align-items-center">
                            <div class="col-lg-6 mb-4 mb-lg-0">
                                <a class="btn btn-outline-dark" href="{{route('shops.index')}}">{{__('messages.Index Page')}}</a>
                                <hr>
                                <img class="card-img-top" src="{{asset(Auth::user()->image)}}" style="width:380px; height: 450px"alt="">
                            </div>
                            <div class="col-lg-6 px-xl-10">
                                <div class="bg-secondary d-lg-inline-block py-1-9 px-1-9 px-sm-6 mb-1-9 rounded">
                                    <h3 class="h2 text-white mb-0">{{Auth::user()->name}}</h3>
                                </div>
                                <ul class="list-unstyled mb-1-9">
                                    <li class="mb-2 mb-xl-3 display-28"><span class="display-26 text-secondary me-2 font-weight-600">
                                            {{__('messages.Email') }}
                                        </span>{{Auth::user()->email}}</li>
                                </ul>
                            </div>
                            <br><br>
                            <hr>
                            <br>
                            <form action="{{route('shops.updateregister',Auth::user()->id)}}" method="get">
                                @csrf
                                <button type="submit" style="margin-right: 0.5rem" class="btn btn-outline-secondary">{{__('messages.Edit')}}</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
{{--    <div class="container">--}}
{{--        <div class="row">--}}
{{--            <div class="col-sm-8">--}}
{{--                <div class="card w-90">--}}
{{--                    <div class="card-body">--}}
{{--                        <img class="card-img-top" src="{{asset(Auth::user()->image)}}" style="width:280px;height: 250px"alt="">--}}
{{--                        <h3 class="card-text">{{Auth::user()->name}}</h3>--}}
{{--                        <h3 class="card-text">{{Auth::user()->email}}</h3>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}




@endsection
