@extends('layout')
@section('content')
    <div class="result" style="height:@if($form) 450px;@else 250px;@endif">
        <div class="status">
            @include('flash::message')
            @if(count($errors))
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger" role="alert">{{ $error }}</div>
                @endforeach
            @endif
        </div>
        <div class="code_form">
            @if(count($form) && $form)
                <div class="explanation">
                    <h1>Voer hier je contactinformatie in</h1>
                    <p>Om u zo snel mogelijk verder te helpen hebben wij een aantal gegevens van u nodig.</p>
                </div>
                <div class="form-control">
                    <form method="POST" action="/mail">
                        {{csrf_field()}}
                        <input type="hidden" id="code" name="code" value="{{$code}}"/>
                        <input type="hidden" id="token" name="token" value="{{$token}}"/>
                        <input type="text" id="firstname" name="firstname" required placeholder="Voer hier je voornaam in">
                        <input type="text" id="lastname" name="lastname" required placeholder="Voer hier je achternaam in">
                        <input type="number" id="age" name="age" required placeholder="Voer hier je leeftijd in" min="0" max="100">
                        <input type="text" id="adres" name="adres" required placeholder="Voer hier je adres in">
                        <input type="email" id="email" name="email" required placeholder="Voer hier je email in">
                        <button type="submit">Submit</button>
                    </form>
                </div>
            @elseif(!$form)
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
            @else
                <!-- Error -->
            @endif
        </div>
    </div>
    </div>
@endsection