@extends('adminlte::page')

@section('title', 'users')

@section('content_header')
<h1>
  {{ $year }}年{{ $month }}月の出勤日数{{ $worked_days }}/{{ $weekdays }}
</h1>
@stop

@section('content')
<div class="container">
  <div class="card">
    <div class="card-body">
      <div class="row">
        <div class="col-md-12">
          <form class="">
            <div class="form-group">
              <label for="year">year</label>
              {{Form::selectYear('year', 2013, $thisYear, $year, ['class' => 'form-control'])}}
              <label for="month">month</label>
              {{Form::selectRange('month','1' ,'12' ,$month ,['class' => 'form-control'])}}
            </div>
            <div class="form-grop">
              <input type="submit" class="btn btn-primary" value="検索">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="col-12">
  <div class="card">
    <div class="card-header">
      <div class="card-tools">
      </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body table-responsive p-0">

      <table class="table table-hover">
        <thead>
          <tr>
            <th>@lang('common.name')</th>
            <th>@lang('common.sum_work_time')</th>
            <th>@lang('common.overtime_hours')</th>
            <th>@lang('common.commit_number')</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($users as $user)
          <tr>
            <td><a href="{{ route('user.show', [$user->id]) }}">{{$user->name}}</a></td>
            <td>{{ round($user->working_time, 0) }}</td>
            <td>
              {{ round($user->overtime, 0) }}
            </td>
            <td>
              {{ $user->commit_number }}
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
