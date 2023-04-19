@extends('layouts.adm')
@section('title') Create Page @endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">

                <form action = "{{route('adm.categories.store')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="NameInput">{{__('messages.Name')}}</label>
                        <input type="string" class="form-control" name="name" id="NameInput" style="margin-bottom: 0.6rem;" placeholder="enter">
                        <input type="string" class="form-control" name="name_ru" id="NameInput" style="margin-bottom: 0.6rem;" placeholder="enter russian">
                        <input type="string" class="form-control" name="name_kz" id="NameInput" style="margin-bottom: 0.6rem;" placeholder="enter kazakh">
                        <input type="string" class="form-control" name="name_en" id="NameInput" style="margin-bottom: 0.6rem;" placeholder="enter english">
                    </div>

                    <div class="form-group">
                        <label for="CodeInput">{{__('messages.Code')}}</label>
                        <input type="string" class="form-control" name="code" id="CodeInput" style="margin-bottom: 0.6rem;" placeholder="...">
                    </div>

                    <div class="form-group mt-3">
                        <button class="btn btn-primary" type="submit">{{__('messages.Save')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
