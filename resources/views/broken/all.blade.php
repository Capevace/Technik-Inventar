@extends('app')

@section('title')
    Defekte Artikel
@endsection

@section('content')
    <h3>Alle defekten Artikel</h3>

    @if(count($items) > 0)
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <th>
                        Artikel
                    </th>
                    <th>
                        Anzahl
                    </th>
                    <th>
                        Kommentar
                    </th>
                    <th>

                    </th>
                </thead>

                <tbody>
                @foreach($items as $item)
                    <tr>
                        <td>
                            {{ $item->item->name }}
                        </td>
                        <td>
                            {{ $item->count }}
                        </td>
                        <td>
                            {{ $item->comment }}
                        </td>
                        <td class="pull-right">
                            <a href="{{ url('items/broken/' . $item->id) }}" class="btn btn-xs btn-primary">Anzeigen</a>&nbsp;
                            <a href="{{ url('items/broken/' . $item->id . '/edit') }}" class="btn btn-xs btn-warning">Bearbeiten</a>&nbsp;
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
@endsection
