@extends('layouts.app')
@section('title', 'INDEX PAGE')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h2 class="display-3" align="center" > {{__('messages.Welcome to Pandora!!!')}}</h2>
                <hr>
                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="https://pandora.kz/upload/iblock/c75/c75b26f11f75f414f83f742fc1215ab4.jpg" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="https://pandora.kz/upload/iblock/75a/75ac22f74ecc8677c0b120da12d21f74.jpg" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="https://pandora.kz/upload/iblock/097/0979e77ca1dd3e60780ca4a97b06ee39.jpg" class="d-block w-100" alt="...">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
                <br>
                @can('create', App\Models\Shop::class)
                    <a class="btn btn-outline-dark" href="{{route('shops.create')}}">{{__('messages.Create Page')}}</a>
                @endcan
                <br><br>
                <br><br>
                <div class="row">
                    @foreach($shops as $shop)
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <img src="{{$shop->image}}" style=" width: 250px ; height: 250px">
                                    <h4 class="card-title">{{$shop->title}}</h4>
                                    <small>{{__('messages.Author:')}} {{$shop->user->name}}</small>
                                    <h3 class="display-7"><span class="badge bg-secondary">{{$shop->price}} ₸</span></h3>                                    <a href="{{route('shops.show',$shop->id)}}" class="btn btn-outline-dark">{{__('messages.More...')}}</a>
                                    @can('delete', $shop)
                                        <form action="{{route('shops.destroy',$shop->id)}}"method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-outline-dark" type="submit">{{__('messages.Delete')}}</button>
                                        </form>
                                    @endcan
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

