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
                <p class="small">
                    Artikel
                </p>

            </h3>
            <div class="row">
                <div class="col-md-3">
                    <img src="@if (!empty($item->img)) {{ $item->img }} @else http://placehold.it/200?text=Artikel @endif" alt="Artikelbild" class="img-thumbnail">
                    <br><br>
                </div>
                <div class="col-sm-4">
                    <h4>Eigenschaften</h4>
                    <div class="list-left">
                        <dl class="dl-horizontal">
                            <dt>Kategorie</dt>
                            <dd>{{ $item->type->name }}</dd>
                            <br>
                            <dt>Frei</dt>
                            <dd>{{ $item->freeCount() }} / {{ $item->total_count }}</dd>
                            <dt>Defekt</dt>
                            <dd>{{ $item->brokenCount() }} / {{ $item->total_count }}</dd>
                            <br>
                            @if(!empty($item->comment))
                                <dt>Kommentar</dt>
                                <dd>{{ $item->comment }}</dd>
                            @endif
                        </dl>
                    </div>
                </div>
                <div class="col-sm-5">
                    <h4>Genutzt in Aufträgen:</h4>
                    @if (count($item->used) <= 0)
                        <p class="lead">Keine Aufträge mit diesem Artikel</p>
                    @else
                        <table class="table">
                            <thead>
                                <th>
                                    Name
                                </th>
                                <th>
                                    Anzahl im Auftrag
                                </th>
                                <th>

                                </th>
                            </thead>
                            <tbody>
                                @foreach($item->used as $used)
                                    <tr>
                                        <td>
                                            {{ $used->job->name }}
                                        </td>
                                        <td>
                                            {{ $used->use_count }}
                                        </td>
                                        <td>
                                            <a href="{{ url('jobs/' . $used->job->id) }}">Anzeigen</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
