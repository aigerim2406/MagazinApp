@extends('layouts.app')
@section('title','ADS PAGE')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="d-flex">
                <a class="btn btn-outline-dark" href="{{route('shop.user')}}">{{__('messages.Index Page')}}</a>
            </div>
            <div class="col-md-10">
                <form action="{{route('shops.editprofile',$user->id)}}" method="post" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="row mb-3">
                        <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('messages.Name') }}</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$user->name}}" required autocomplete="name" autofocus>

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('messages.Email') }}</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{$user->email}}" required autocomplete="email">

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="imageInput" class="col-md-4 col-form-label text-mb-end">{{__('messages.Image:')}}</label>
                        <div class="col-sm-6">
                            <input type="file" class="form-control" @error('image') is-invalid @enderror id="imageInput" name="image" placeholder="">
                            @error('image')
                            <div class="alert alert-danger">{{$message}}</div>
                            @enderror
                        </div>

                    </div>

                    <div class="form-group mt-3">
                        <button type="submit" class="btn btn-success"> {{__('messages.Save')}} </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
