@extends('app')

@section('title')
	Gelder
@endsection

@section('content')
	<h3>
		Gelder
		<button href="#" class="pull-right btn btn-primary" data-toggle="modal" data-target="#create-modal">Hinzufügen</button>
		<p class="small">
			Total: {{ $total }} €
		</p>

	</h3>
	<table class="table">
		<thead>
			<th>
				ID
			</th>
			<th>
				Bezeichnung
			</th>
			<th>
				Datum
			</th>
			<th class="text-right">
				Wert
			</th>
			<th>

			</th>
		</thead>
		<tbody>
			@foreach($funds as $fund)
				<tr class="@if($fund->value < 0) danger @else success @endif">
					<td>
						{{ $fund->id }}
					</td>
					<td>
						{{ $fund->name }}
					</td>
					<td>
						{{ \Carbon\Carbon::parse($fund->created_at)->format('j\\.m\\.Y') }}
					</td>
					<td>
						<span class="pull-right">{{ $fund->value }} €</span>
					</td>
					<td>
						<div class="pull-right">
							<button data-id="{{ $fund->id }}" data-name="{{ $fund->name }}" data-value="{{ $fund->value }}" class="btn btn-xs btn-warning btn-edit">Bearbeiten</button>
							<form action="{{ url('funds/' . $fund->id) }}" method="post" style="display: inline;">
								{{ csrf_field() }}
								{{ method_field('DELETE') }}
								<button type="sunmit" class="btn btn-xs btn-danger">Löschen</button>
							</form>
						</div>
					</td>
				</tr>
			@endforeach
		</tbody>
		<tfoot>
			<th></th>
			<th></th>
			<th>{{ \Carbon\Carbon::now()->format('j\\.m\\.Y') }}</th>
			<th class="text-right lead">Total: {{ $total }} €</th>
		</tfoot>
	</table>

	<!-- Modal -->
	<div class="modal fade" id="create-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Transaktion hinzufügen</h4>
					</div>
					<div class="modal-body">
						<form class="form-horizontal create-form" action="{{ url('funds') }}" method="post">
							{{ csrf_field() }}
							<div class="form-group">
								<label for="name" class="col-sm-2 control-label">Bezeichnung</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="name" name="name" placeholder="Bezeichnung" required="">
								</div>
							</div>
							<div class="form-group">
								<label for="value" class="col-sm-2 control-label">Wert (in €)</label>
								<div class="col-sm-10">
									<div class="input-group">
										<input type="number" class="form-control" id="value" name="value" placeholder="Wert (in €)" required="">
										<div class="input-group-addon">€</div>
									</div>
								</div>
							</div>
						</form>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Abbrechen</button>
						<button type="button" class="btn btn-primary submit" data-form=".create-form">Hinzufügen</button>
					</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Transaktion bearbeiten</h4>
					</div>
					<div class="modal-body">
						<form class="form-horizontal edit-form" action="index.html" method="post">
							{{ method_field('PUT') }}
							{{ csrf_field() }}
							<div class="form-group">
								<label for="name" class="col-sm-2 control-label">Bezeichnung</label>
								<div class="col-sm-10">
									<input type="text" class="form-control name-field" id="name" name="name" placeholder="Bezeichnung" required="">
								</div>
							</div>
							<div class="form-group">
								<label for="value" class="col-sm-2 control-label">Wert (in €)</label>
								<div class="col-sm-10">
									<div class="input-group">
										<input type="number" class="form-control value-field" id="value" name="value" placeholder="Wert (in €)" required="">
										<div class="input-group-addon">€</div>
									</div>
								</div>
							</div>
						</form>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Abbrechen</button>
						<button type="button" class="btn btn-primary submit" data-form=".edit-form">Speichern</button>
					</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		$(document).ready(function () {
			$('.btn-edit').click(function (event) {
				var button = $(event.target); // Button that triggered the modal
				var name = button.data('name');
				var value = button.data('value');
				var id = button.data('id');

				var modal = $('#edit-modal');
				modal.find('.name-field').val(name);
				modal.find('.value-field').val(value);
				modal.find('.edit-form').attr('action', '{{ url('funds') }}/' + id);

				modal.modal();
			});

			$('button.submit').click(function (e) {
				var form = $($(e.target).data('form'));
				console.log($($(e.target).data('form')));
				form.submit();
			});
		});
	</script>
@endsection
