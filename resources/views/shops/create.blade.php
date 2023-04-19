@extends('layouts.app')
@section('title', 'INDEX PAGE')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <form action="{{route('shops.store')}}" method="post" enctype="multipart/form-data">
                @csrf

                 <div class="form-group">
                     <label for="titleInput">{{__('messages.Title:')}}</label>
                     <input type="text" class="form-control" id="titleInput" name="title" placeholder="...">
                 </div>
                 <br>
                 <div class="form-group">
                     <label for="imageInput">{{__('messages.Image:')}}</label>
                     <input type="file" class="form-control @error('image') is-invalid @enderror" id="imageInput" name="image" >
                     @error('image')
                     <div class="alert alert-danger">{{$message}}</div>
                     @enderror
                 </div>

{{--                    <div class="form-group">--}}
{{--                        <label for="imageInput">{{__('messages.Image:')}}</label>--}}
{{--                        <input type="file" class="form-control @error('image') is-invalid @enderror" id="imageInput" name="image" >--}}
{{--                        @error('image')--}}
{{--                        <div class="alert alert-danger">{{$message}}</div>--}}
{{--                        @enderror--}}
{{--                    </div>--}}

                 <br>
                 <div class="form-group">
                     <label for="categoryInput">{{__('messages.Category:')}}</label>
                     <select class="form-select" name="category_id">
                         @foreach($categories as $cat)
                             <option value="{{$cat->id}}">{{$cat->name}}</option>
                         @endforeach
                     </select>
                 </div>
                 <br>
                 <div class="form-group">
                     <label for="priceInput">{{__('messages.Price:')}}</label>
                     <input class="form-control" type="number" id="priceInput" name="price">
                 </div>
                 <br>
            <div>
                <button class="btn btn-outline-success" type="submit">{{__('messages.Save')}}</button>
            </div>
         </form>
            </div>
        </div>
    </div>
@endsection
