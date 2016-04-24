@extends('app')

@section('title')
    Aufträge
@endsection

@section('content')
    <h3>Alle Aufträge</h3>

    @if(count($jobs) > 0)
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <th>
                        ID
                    </th>
                    <th>
                        Name
                    </th>
                    <th>
                        Art
                    </th>
                    <th>
                        Beginnt am
                    </th>
                    <th>
                        Endet am
                    </th>
                    <th>

                    </th>
                </thead>

                <tbody>
                @foreach($jobs as $job)
                    <tr>
                        <td>
                            {{ $job->id }}
                        </td>
                        <td>
                            {{ $job->name }}
                        </td>
                        <td>
                            @if($job->is_rental)
                                Verleih
                            @else
                                Auftrag
                            @endif
                        </td>
                        <td>
                            {{ date('d. F Y', strtotime($job->time_start)) }}
                        </td>
                        <td>
                            {{ date('d. F Y', strtotime($job->time_end)) }}
                        </td>
                        <td class="pull-right">
                            <a href="{{ url('jobs/' . $job->id) }}" class="btn btn-xs btn-link">Anzeigen</a>
                            <a href="{{ url('jobs/' . $job->id . '/edit') }}" class="btn btn-xs btn-link">Bearbeiten</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>

            </table>
        </div>
    @else
        <br>
        <h4><center>Keine Aufträge gefunden</center></h4>
    @endif
@endsection
