@extends('app')

@section('title')
    Nutzer bearbeiten
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12" id="item-add-table">
            <h3>
                {{ $user->name }}
                <p class="small">
                    Nutzer
                </p>
            </h3>
            <div class="row">
                <div class="col-sm-12">
                    <h4>Eigenschaften</h4>
                    <form class="form" action="{{ url('users/' . $user->id . '/edit') }}" method="post">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <label for="name">Name:</label>
                                <input type="text" name="name" value="{{ $user->name }}" class="form-control" placeholder="Name" required="">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label for="email">Email:</label>
                                <input type="email" name="email" value="{{ $user->email }}" class="form-control" placeholder="E-Mail">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <label for="role">Rolle:</label>
                                <select class="form-control" name="role">
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}" @if($user->roles->first()->id == $role->id) selected="" @endrole>{{ $role->display_name }}</option>
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
                                <button type="submit" name="button" class="btn btn-primary">Nutzer speichern</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
