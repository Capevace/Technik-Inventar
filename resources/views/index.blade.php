@extends('app')

@section('title')
	Technik Inventar
@endsection


@section('content')
	<div class="row">
		<div class="col-sm-12">
			<div class="jumbotron">
				<h1>Technik Inventar</h1>
				<p>© {{ \Carbon\Carbon::now()->format('Y') }} Lukas von Mateffy</p>
			</div>
		</div>
	</div>
@endsection
