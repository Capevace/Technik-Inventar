@extends('app')

@section('title')
    Nutzer hinzufügen
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12" id="item-add-table">
            <h3>
                Nutzer hinzufügen
            </h3>
            <div class="row">
                <div class="col-sm-12">
                    <h4>Eigenschaften</h4>
                    <form class="form" action="{{ url('users/create') }}" method="post">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <label for="name">Name:</label>
                                <input type="text" name="name" value="" class="form-control" placeholder="Name" required="">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label for="email">E-Mail:</label>
                                <input type="email" name="email" value="" class="form-control" placeholder="E-Mail" required="">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <label for="password">Passwort:</label>
                                <input type="password" name="password" value="" class="form-control" placeholder="Passwort" required="">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label for="password_confirmation">Passwort wiederholen:</label>
                                <input type="password" name="password_confirmation" value="" class="form-control" placeholder="Passwort wiederholen" required="">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <label for="role">Rolle:</label>
                                <select class="form-control" name="role" required="">
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->display_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label>Rollen</label>
                                <ul>
                                    @foreach($roles as $role)
                                        <li>
                                            {{ $role->display_name }}
                                            <p class="small">
                                                {{ $role->description }}
                                            </p>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <button type="submit" name="button" class="btn btn-primary">Auftrag speichern</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
