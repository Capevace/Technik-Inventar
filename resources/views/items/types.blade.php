@extends('app')

@section('title')
    Artikel
@endsection

@section('content')
    <h3>
        Alle Artikel-Kategorien
        <a type="button" class="btn btn-primary btn-sm pull-right" data-toggle="modal" data-target="#create-modal">Hinzufügen</a>
    </h3>

    @if(count($types) > 0)
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
                        Beschreibung
                    </th>
                    <th>

                    </th>
                </thead>

                <tbody>
                @foreach($types as $type)
                    <tr>
                        <td>
                            {{ $type->id }}
                        </td>
                        <td>
                            {{ $type->name }}
                        </td>
                        <td>
                            {{ $type->comment }}
                        </td>
                        <td class="pull-right">
                            <a href="#" class="btn btn-xs btn-warning" data-id="{{ $type->id }}" data-name="{{ $type->name }}" data-comment="{{ $type->comment }}" data-toggle="modal" data-target="#edit-modal">Bearbeiten</a>
                            <form class="" action="{{ url('items/types/' . $type->id . '/delete')}}" method="post" style="display: inline;">
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-xs btn-danger">Löschen</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>

            </table>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="create-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form class="" action="{{ url('items/types/create') }}" method="post">
                        {{ csrf_field() }}
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Kategorie hinzufügen</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name" class="control-label">Name:</label>
                                <input type="text" class="form-control" name="name" required="" placeholder="Name">
                            </div>
                            <div class="form-group">
                                <label for="comment" class="control-label">Beschreibung:</label>
                                <textarea name="comment" required="" class="form-control" placeholder="Beschreibung"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Schließen</button>
                            <button type="submit" class="btn btn-primary">Speichern</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form class="" data-url="{{ url('users/') }}" action="#" method="post">
                        {{ csrf_field() }}
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Kategorie bearbeiten</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name" class="control-label">Name:</label>
                                <input type="text" class="form-control" name="name" required="">
                            </div>
                            <div class="form-group">
                                <label for="comment" class="control-label">Beschreibung:</label>
                                <textarea name="comment" required="" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Schließen</button>
                            <button type="submit" class="btn btn-primary">Speichern</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script type="text/javascript">
        $('#edit-modal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var modal = $(this);
            var $form = modal.find('form');
            $form.find('input[name=name]').val(button.attr('data-name'));
            $form.find('textarea[name=comment]').val(button.attr('data-comment'));
            $form.attr('action', '{{ url('items/types') }}/' + button.attr('data-id'));
        })
        </script>
    @else
        <br>
        <h4><center>Keine Artikel gefunden</center></h4>
    @endif
@endsection
