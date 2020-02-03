@extends('adminlte::page')

@section('title', 'projects')

@section('content_header')
<h1>Projects</h1>
@stop

@section('content')
<div class="col-12">
  <div class="card">
    <div class="card-body table-responsive p-0">
      <table class="table table-hover table-bordered sticky_table">
        <thead>
          <tr>
            <th>ID</th>
            <th>name</th>
            <th>sum_time</th>
            <th>latest</th>
            <th>est_time</th>
            <th>unit_price</th>
            <th>progress</th>
            <th>loss</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($projects as $project)
          <tr>
            <td>
              <small>
                {{ $project->id }}
              </small>
            </td>
            <td>
              {{ $project->name }}
            </td>
            <td>
              {{ round($project->sum, 0) }}
            </td>
            @if ($project->is_latest === 1)
            <td style="color:red">{{ $project->latest_entry }}</td>
            @else
            <td>{{ $project->latest_entry }}</td>
            @endif
            <td>
              @if ($project->est_price)
              ￥
              {{ $project->est_price }}
              @else
              {{ $project->est_time }}
              h
              @endif
            </td>
            <td>{{ $project->unit_price }}</td>
            <td>{{ $project->progress }}</td>
            @if ($project->cal_progress > $project->progress)
            <td>￥{{ round(($project->est_time - $project->sum)*$project->unit_price/10000, 1) }}万</td>
            @endif
          </tr>
          @endforeach
        </tbody>
      </table>
      <nav aria-label="Page navigation">
        <ul class="pagination">
          <li class="page-item">
            <a class="page-link" href="#">Prev</a>
          </li>
          <li class="page-item">
            <a class="page-link" href="#">1</a>
          </li>
          <li class="page-item">
            <a class="page-link" href="#">2</a>
          </li>
          <li class="page-item"><a class="page-link" href="#">3</a></li>
          <li class="page-item"><a class="page-link" href="#">Next</a></li>
        </ul>
      </nav>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
@stop


@section('css')
<link rel="stylesheet" href="{{ asset('resources/css/common.css') }}">
@stop

@section('js')
<script>
  console.log('Hi!');
</script>
@stop
@section('content')

@endsection
