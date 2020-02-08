@extends('adminlte::page')

@section('title', 'projects')

@section('content_header')
<h1>Projects</h1>
@stop

@section('content')
<div class="col-12">
  <div class="card">
    <div class="card-body table-responsive p-0">
      <table class="table table-hover table-bordered">
        <thead class="text-nowrap">
          <tr>
            <th>@lang('common.name')</th>
            <th>@lang('common.latest')</th>
            <th>@lang('common.sum_work_time')</th>
            <th>@lang('common.est_time')</th>
            <th>@lang('common.est_price')</th>
            <th>@lang('common.unit_price')</th>
            <th>@lang('common.progress')</th>
            <th>@lang('common.profit_time')</th>
            <th>@lang('common.profit_price')</th>
            <th>@lang('common.out_price')</th>
            <th>@lang('common.is_skip_rank')</th>
            <th>@lang('common.remaining_time')</th>
            <th>@lang('common.generalize')</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($projects as $project)
          <tr>
            <td data-toggle="modal" data-target="#exampleModal" data-id="{{ $project->id }}"
              data-name="{{ $project->name }}" data-est_time="{{ $project->est_time }}"
              data-est_price="{{ $project->est_price }}" data-out_price="{{ $project->out_price }}"
              data-unit_price="{{ $project->unit_price }}" data-progress="{{ $project->progress }}"
              data-is_skip_rank="{{ $project->is_skip_rank }}">
              <small>
                {{ $project->name }}
              </small>
            </td>
            @if ($project->is_latest === 1)
            <td class="red">{{ $project->latest_entry }}</td>
            @else
            <td>{{ $project->latest_entry }}</td>
            @endif
            <td>
              {{ round($project->sum_work_time, 1) }}
            </td>
            <td>{{ $project->est_time }}h</td>
            <td>￥{{ round($project->est_price/10000, 1) }}万</td>
            <td>￥{{ $project->unit_price }}</td>
            <td>{{ $project->progress }}%</td>
            @if ($project->work_time_rate > $project->progress)
            <td class="red">{{ round($project->profit_time, 1) }}</td>
            @else
            <td>{{ round($project->profit_time, 1) }}</td>
            @endif
            @if ($project->work_time_rate > $project->progress)
            <td class="red">￥{{ round($project->profit_price/10000, 1) }}万</td>
            @else
            <td>￥{{ round($project->profit_price/10000, 1) }}万</td>
            @endif
            <td>{{ $project->out_price }}</td>
            <td>{{ $project->is_skip_rank }}</td>
            <td>{{ round($project->remaining_time, 1) }}h</td>
            <td>
              <button type="button" class="btn btn-block btn-info btn-sm">
                <i class="fas fa-hand-paper"></i>
              </button>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@stop

@include('project.modal.edit')


@section('css')
<style>
  .red {
    color: red;
  }
</style>
@stop

@section('js')
<script src="js/project.js" type="text/javascript"></script>
@stop
@section('content')

@endsection
