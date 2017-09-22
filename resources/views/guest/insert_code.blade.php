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
            <div class="explanation">
                <h1>Voer je code hier in!</h1>
                <h4>Prijzen niet gegarandeerd.</h4>
                <p>Om mee te doen hoef je alleen, maar de code in te voeren die je ontvangen hebt.<br/>
                Hierna hoor je meteen of je code geldig is en krijg je per mail binnen of je iets gewonnen hebt.</p>
            </div>
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