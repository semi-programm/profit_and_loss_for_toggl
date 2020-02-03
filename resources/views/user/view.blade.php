@extends('adminlte::page')

@section('title', 'user_detail')

@section('content_header')
<h1>user_detail</h1>
@stop

@section('content')
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Responsive Hover Table</h3>
    <div class="card-tools">
    </div>
  </div>

  <div class="card-body table-responsive p-0">
    <table class="table table-hover">
      <tbody>
        <td>
          名前
        </td>
        <th>
          {{ $user->name }}
        </th>
      </tbody>
    </table>
  </div>
</div>
{{-- <form action="user/{{ $user->id }}" method="post"> --}}
<form action="{{ route('user.destroy', ['user' => $user->id]) }}" id="" method="post">
  @method('delete')
  @csrf
  <input type="submit" value="削除">
</form>
{{-- <button type="button" class="btn btn-block bg-gradient-danger btn-lg " href="{{ route('user.destroy', [$user->id]) }}">
<i class="fas fa-trash"></i>
</button> --}}
@stop


@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop
@section('content')
@endsection
