@extends('app')

@section('title')
    Artikel erstellen
@endsection

@section('content')
    <h3>Artikel erstellen</h3>
    <form class="form" action="{{ url('items/create') }}" method="post">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-sm-4 form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" value="" class="form-control" placeholder="Name" required="">
            </div>
            <div class="col-sm-4 form-group">
                <label for="count">Anzahl:</label>
                <input type="number" name="total_count" value="1" min="1" class="form-control" placeholder="Anzahl" required="">
            </div>
            <div class="col-sm-4 form-group">
                <label for="type">Kategorie:</label>
                <select class="form-control" name="type_id" required="">
                    @foreach($types as $type)
                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-8 form-group">
                <label for="comment">Beschreibung:</label>
                <textarea name="comment" class="form-control" placeholder="Beschreibung"></textarea>
            </div>
            <div class="col-sm-4 form-group">
                <label for="count">Bild-URL:</label>
                <input type="url" name="count" class="form-control" placeholder="URL">
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <button type="submit" name="button" class="btn btn-primary">Artikel erstellen</button>
            </div>
        </div>
    </form>
@endsection
