@extends('app')

@section('title')
    Artikel
@endsection

@section('content')
    <h3>Alle Artikel</h3>

    @if(count($items) > 0)
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
                        Kategorie
                    </th>
                    <th>
                        Frei
                    </th>
                    <th>
                        Defekt
                    </th>
                    <th>

                    </th>
                </thead>

                <tbody>
                @foreach($items as $item)
                    <tr>
                        <td>
                            {{ $item->id }}
                        </td>
                        <td>
                            {{ $item->name }}
                        </td>
                        <td>
                            {{ $item->type->name }}
                        </td>
                        <td>
                            {{ $item->freeCount() }} / {{ $item->total_count }}
                        </td>
                        <td>
                            {{ $item->brokenCount() }} / {{ $item->total_count }}
                        </td>
                        <td class="pull-right">
                            <a href="{{ url('items/' . $item->id) }}" class="btn btn-xs btn-primary">Anzeigen</a>
                            <a href="{{ url('items/' . $item->id . '/edit') }}" class="btn btn-xs btn-warning">Bearbeiten</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>

            </table>
        </div>
    @else
        <br>
        <h4><center>Keine Artikel gefunden</center></h4>
    @endif
@endsection
