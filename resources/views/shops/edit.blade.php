@extends('layouts.app')
@section('title', 'EDIT PAGE')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <a class="btn btn-outline-dark" href="{{route('shops.index')}}">{{__('messages.Index Page')}}</a>
                <br><hr>
                <form action="{{route('shops.update',$shop->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                    <div class="form-group">
                        <label for="titleInput">{{__('messages.Title:')}}</label>
                        <input type="text" class="form-control" id="titleInput" name="title" value="{{$shop->title}}">
                        <div class="invalid-feedback"></div>
                    </div>
<hr>
                    <div class="form-group">
                        <img src="{{$shop->image}}" style="height: 300px; width: 300px">
                    </div>
<hr>
                    <div class="form-group">
                        <label for="imageInput" class="col-md-4 col-form-label text-mb-end">{{__('messages.Image:')}}</label>
                        <div class="col-sm-6">
                            <input type="file" class="form-control @error('image') is-invalid @enderror" id="imageInput" name="image" >
                            @error('image')
                            <div class="alert alert-danger">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
<hr>
                    <div>
                        <label for="categoryInput">{{__('messages.Category:')}}
                        <select multiple class="form-control" id="categoryInput" name="category_id">
                            @foreach($categories as $cat)
                                <option @if($cat->id == $shop->category_id) selected @endif value="{{$cat->id}}">{{$cat->name}}</option>
                            @endforeach
                        </select>
                        </label>
                    </div>
                    <br><hr>
                    <div>
                        <label for="priceInput">{{__('messages.Price:')}} </label>
                        <input type="number" class="form-control" id="priceInput" name="price" value="{{$shop->price}}">
                        <div class="invalid-feedback"></div>
                    </div>
                    <br>
                    <div>
                        <button class="btn btn-outline-success" type="submit">{{__('messages.Edit')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection




