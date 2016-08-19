@extends('app')

@section('title')
    QuickView
@endsection

@section('content')
    <h3>
        QuickView
    </h3>
    <div class="row">
        <div class="col-md-6">
            <h4>Artikel finden</h4>
            <form class="" action="{{ url('quick/items') }}" method="post">
                {!! csrf_field() !!}
                <div class="form-group">
                    <label for="query">Artikel Name, ID o.ä.</label>
                    <input type="text" name="query" placeholder="z.B. 'XLR-Kabel' oder '224'" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Suchen</button>
            </form>
        </div>
        <div class="col-md-6">
            <h4>Auftrag finden</h4>
            <form class="" action="{{ url('quick/jobs') }}" method="post">
                {!! csrf_field() !!}
                <div class="form-group">
                    <label for="query">Auftrags Name, ID o.ä.</label>
                    <input type="text" name="query" placeholder="z.B. 'Big Band' oder '10'" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Suchen</button>
            </form>
        </div>
    </div>

@endsection
