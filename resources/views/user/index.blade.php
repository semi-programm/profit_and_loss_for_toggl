@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Dashboard</h1>
@stop

@section('content')
<div class="col-12">
	<div class="card">
		<div class="card-header">
			<h3 class="card-title">Responsive Hover Table</h3>
			<div class="card-tools">
			</div>
		</div>
		<!-- /.card-header -->
		<div class="card-body table-responsive p-0">

			<table class="table table-hover">
				<thead>
					<tr>
						<th>id</th>
						<th>{{ __('user_name') }}</th>
                        <th>sum_working_time</th>
                        <th>overtime_hours</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($users as $user)
					<tr>
						<td>{{ $user->id }}</td>
						<td><a href="{{ action('UserController@view', $user->id) }}">{{$user->name}}</a></td>
                        <td>{{ round($user->working_time, 0) }}</td>
                        <td>
                            {{ $user->overtime }}
                        </td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		<!-- /.card-body -->
	</div>
	<!-- /.card -->
</div>
@stop


@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script>
	console.log('Hi!');
</script>
@stop
@section('content')

@endsection
