@extends('app')

@section('title')
    Nutzer
@endsection

@section('content')
    <h3>
		Alle Nutzer
		<a href="{{ url('users/create') }}" class="btn btn-primary btn-sm pull-right">
            Hinzufügen
        </a>
	</h3>

    @if(count($users) > 0)
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
                        Email
                    </th>
                    <th>
                        Rolle
                    </th>
                    <th>

                    </th>
                </thead>

                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>
                            {{ $user->id }}
                        </td>
                        <td>
                            {{ $user->name }}
                        </td>
                        <td>
                            {{ $user->email }}
                        </td>
                        <td>
                            {{ $user->roles->first()->display_name }}
                        </td>
                        <td class="pull-right">
                            <a href="{{ url('users/' . $user->id) }}" class="btn btn-xs btn-primary">Bearbeiten</a>&nbsp;
                            <a href="#" class="btn btn-xs btn-warning" data-toggle="modal" data-target="#item-modal" data-id="{{ $user->id }}">Passwort ändern</a>&nbsp;
							<form class="" action="{{ url('users/' . $user->id . '/delete') }}" method="post" style="display: inline;">
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
        <div class="modal fade" id="item-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form class="" data-url="{{ url('users/') }}" action="#" method="post">
                        {{ csrf_field() }}
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="password" class="control-label">Passwort:</label>
                                <input type="password" class="form-control" name="password" required="">
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation" class="control-label">Passwort wiederholen:</label>
                                <input type="password" class="form-control" name="password_confirmation" required="">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Schließen</button>
                            <button type="submit" class="btn btn-primary">Passwort ändern</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script type="text/javascript">
        $('#item-modal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var modal = $(this);
            var $form = modal.find('form');
            $form.attr('action', '{{ url('users') }}/' + button.attr('data-id') + '/password');
        })
        </script>
    @else
        <br>
        <h4><center>Keine Aufträge gefunden</center></h4>
    @endif
@endsection
