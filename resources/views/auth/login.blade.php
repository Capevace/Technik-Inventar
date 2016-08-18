@extends('app')
@section('content')

<div class="row">
    <div class="col-sm-3"></div>
    <div class="col-sm-6">
        <h3>
            Anmelden
        </h3>
        <form class="form-" action="{{ url('login') }}" method="POST">
            {!! csrf_field() !!}

            <div class="form-group">
                <label for="name">Name: </label>
                <input type="text" name="name" value="" class="form-control">
            </div>

            <div class="form-group">
                <label for="password">Passwort: </label>
                <input type="password" name="password" value="" class="form-control">
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="remember"> Angemeldet bleiben
                </label>
            </div>
            <br>
            <button type="submit" name="submit" class="btn btn-primary">Anmelden</button>
        </form>
    </div>
    <div class="col-sm-3"></div>
</div>


@endsection

@section('title')
    Anmelden
@endsection
