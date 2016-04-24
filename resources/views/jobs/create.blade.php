@extends('app')

@section('title')
    Auftrag erstellen
@endsection

@section('content')

    <h3>Auftrag erstellen</h3>

    <form class="form" action="{{ url('jobs/create') }}" method="post">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-sm-6 form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" value="" class="form-control" placeholder="Name" required="">
            </div>
            <div class="col-sm-6 form-group">
                <label for="is_rental">Kategorie:</label>
                <select class="form-control" name="is_rental" required="">
                    <option value="0">Auftrag</option>
                    <option value="1">Verleih</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 form-group">
                <label for="leader">Zugeteilter Techniker:</label>
                <select class="form-control" name="leader" required="">
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-6 form-group">
                <label for="recipent">Auftraggeber:</label>
                <input type="text" name="recipent" value="" class="form-control" placeholder="Name" required="">
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 form-group">
                <label for="time_start">Beginnt am:</label>
                <input type="date" name="time_start" class="form-control" value="{{ date('Y-m-d') }}">
            </div>
            <div class="col-sm-6 form-group">
                <label for="time_end">Endet am:</label>
                <input type="date" name="time_end" class="form-control" value="{{ date('Y-m-d') }}">
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 form-group">
                <label for="description">Beschreibung:</label>
                <textarea name="description" class="form-control" placeholder="Beschreibung"></textarea>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <button type="submit" name="button" class="btn btn-primary">Artikel erstellen</button>
            </div>
        </div>
    </form>
@endsection
