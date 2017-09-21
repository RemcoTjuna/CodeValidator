@extends('layout')
@section('content')
    <div class="result">
        <div class="status">
            @include('flash::message')
            @if(count($errors))
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger" role="alert">{{ $error }}</div>
                @endforeach
            @endif
        </div>
        <div class="code_form">
            <div class="form-control">
                <form method="POST" action="/code">
                    {{csrf_field()}}
                    <input type="text" id="uuid" name="uuid" placeholder="Voer hier je code in"/>
                    <button type="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection