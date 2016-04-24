@extends('app')

@section('title')
    Artikel bearbeiten
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-tabs check-active-links">
                <li><a href="{{ url('items/' . $item->id) }}">Artikel anzeigen</a></li>
                <li><a href="{{ url('items/' . $item->id . '/edit') }}">Artikel Bearbeiten</a></li>
            </ul>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <h3>
                {{ $item->name }}
                <p class="small">
                    Artikel
                </p>
            </h3>
            <form class="form" action="{{ url('items/' . $item->id . '/edit') }}" method="post">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-sm-4 form-group">
                        <label for="name">Name:</label>
                        <input type="text" name="name" value="{{ $item->name }}" class="form-control" placeholder="Name" required="">
                    </div>
                    <div class="col-sm-4 form-group">
                        <label for="total_count">Anzahl:</label>
                        <input type="number" name="total_count" value="{{ $item->total_count }}" min="1" class="form-control" placeholder="Anzahl" required="">
                    </div>
                    <div class="col-sm-4 form-group">
                        <label for="type_id">Kategorie:</label>
                        <select class="form-control" name="type_id" required="">
                            @foreach($types as $type)
                                <option value="{{ $type->id }}" @if($item->type->id == $type->id) selected="" @endif>{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-8 form-group">
                        <label for="comment">Beschreibung:</label>
                        <textarea name="comment" class="form-control" placeholder="Beschreibung">{{ $item->comment }}</textarea>
                    </div>
                    <div class="col-sm-4 form-group">
                        <label for="img">Bild-URL:</label>
                        <input type="url" name="img" value="{{ $item->img }}" class="form-control" placeholder="URL">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <button type="submit" name="button" class="btn btn-primary">Artikel speichern</button>
                                </form>
                    </div>
                    <div class="col-sm-6">
                        <form class="" action="{{ url('items/' . $item->id . '/delete') }}" method="post">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger pull-right">Löschen</button>
                        </form>
                    </div>
                </div>
        </div>
    </div>
@endsection
