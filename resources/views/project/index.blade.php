@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Projects</h1>
@stop

@section('content')
<div class="col-12">
  <div class="card">
    <div class="card-body table-responsive p-0">
      <table class="table table-hover">
        <thead>
          <tr>
            <th>ID</th>
            <th>name</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($projects as $project)
          <tr>
            <td>{{ $project->id }}</td>
            <td>
                {{ $project->name }}
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
