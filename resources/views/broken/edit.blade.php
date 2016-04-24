@extends('app')

@section('title')
    Defekten Artikel bearbeiten
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-tabs check-active-links">
                <li><a href="{{ url('items/' . $item->id) }}">Artikel anzeigen</a></li>
                <li><a href="{{ url('items/' . $item->id . '/edit') }}">Artikel Bearbeiten</a></li>
                <li><a href="{{ url('items/' . $item->id . '/broken') }}">Defekte Artikel</a></li>
            </ul>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-sm-12">
            <h3>Markierung als "defekt" bearbeiten</h3>
            <form class="form" action="{{ url('items/' . $item->id . '/broken/' . $broken->id . '/edit') }}" method="post">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-sm-12 form-group">
                        <label for="count">Anzahl:</label>
                        <input type="number" name="count" value="{{ $broken->count }}" min="1" class="form-control" placeholder="Anzahl" required="">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 form-group">
                        <label for="comment">Kommentar:</label>
                        <textarea name="comment" class="form-control" placeholder="Kommentar">{{ $broken->comment }}</textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <button type="submit" name="button" class="btn btn-primary">Speichern</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
