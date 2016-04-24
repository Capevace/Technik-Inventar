@extends('app')

@section('title')
    Artikel anzeigen
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
        <div class="col-md-12">
            <h3>
                {{ $item->name }}
                <a href="{{ url('items/' . $item->id . '/broken/report') }}" class="btn btn-primary pull-right">Als defekt melden</a>
                <p class="small">
                    Defekt
                </p>
            </h3>
            <div class="row">
                @if(count($item->broken))
                    <div class="col-sm-12 table-responsive">
                        <table class="table">
                            <thead>
                                <th>
                                    Kommentar
                                </th>
                                <th>
                                    Anzahl
                                </th>
                                <th>

                                </th>
                            </thead>
                            <tbody>
                                @foreach($item->broken as $broken)
                                    <tr>
                                        <td>
                                            {{ $broken->comment }}
                                        </td>
                                        <td>
                                            {{ $broken->count }}
                                        </td>
                                        <td class="pull-right">
                                            <a href="{{ url('items/' . $item->id . '/broken/' . $broken->id . '/edit') }}" class="btn btn-primary btn-sm">Bearbeiten</a>
                                            <form action="{{ url('items/' . $item->id . '/broken/' . $broken->id . '/close') }}" method="post" style="display: inline;">
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm">Löschen</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <br>
                    <h4><center>Keine defekten Artikel gefunden</center></h4>
                @endif

            </div>
        </div>
    </div>
@endsection
