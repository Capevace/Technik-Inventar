@extends('app')

@section('title')
    Auftrag anzeigen
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-tabs check-active-links">
                <li><a href="{{ url('jobs/' . $job->id) }}">Auftrag anzeigen</a></li>
                <li><a href="{{ url('jobs/' . $job->id . '/edit') }}">Auftrag Bearbeiten</a></li>
            </ul>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <h3>
                {{ $job->name }}
                <p class="small">
                    Auftrag
                </p>
            </h3>
            <div class="row">
                <div class="col-sm-7">
                    <h4>Eigenschaften</h4>
                    <div class="list-left">
                        <dl class="dl-horizontal">
                            <dt>Name</dt>
                            <dd>{{ $job->name }}</dd>

                            <dt>Art</dt>
                            @if ($job->is_rental)
                                <dd>Verleih</dd>
                            @else
                                <dd>Auftrag</dd>
                            @endif

                            @if(!empty($job->recipent))
                                <dt>Auftraggeber</dt>
                                <dd>{{ $job->recipent }}</dd>
                            @endif

                            <dt>Verantwortlicher</dt>
                            <dd>{{ $job->user->name }}</dd>

                            <dt>Beginnt am</dt>
                            <dd>{{ date('d. F Y', strtotime($job->time_start)) }}</dd>

                            <dt>Endet am</dt>
                            <dd>{{ date('d. F Y', strtotime($job->time_end)) }}</dd>

                            @if(!empty($job->description))
                                <dt>Beschreibung</dt>
                                <dd>{{ $job->description }}</dd>
                            @endif

                            <br>
                        </dl>
                    </div>
                </div>
                <div class="col-sm-5">
                    <h4>Genutzte Artikel:</h4>
                    @if (count($job->items) <= 0)
                        <p class="lead">Keine Artikel in diesem Auftrag</p>
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
                                @foreach($job->items as $used_item)
                                    <tr>
                                        <td>
                                            {{ $used_item->item->name }}
                                        </td>
                                        <td>
                                            {{ $used_item->use_count }}
                                        </td>
                                        <td>
                                            <a href="{{ url('items/' . $used_item->item->id) }}">Anzeigen</a>
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
