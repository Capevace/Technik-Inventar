@extends('app')

@section('title')
    Defekten Artikel melden
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
            <h3>"{{ $item->name }}" als defekt melden</h3>
            <form class="form" action="{{ url('items/' . $item->id . '/broken/report') }}" method="post">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-sm-12 form-group">
                        <label for="count">Anzahl ({{ $item->freecount() }} markierbar):</label>
                        <input type="number" name="count" value="1" min="1" max="{{ $item->freeCount() }}" class="form-control" placeholder="Anzahl" required="">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 form-group">
                        <label for="comment">Kommentar:</label>
                        <textarea name="comment" class="form-control" placeholder="Kommentar" required=""></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <button type="submit" name="button" class="btn btn-primary">Melden</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
