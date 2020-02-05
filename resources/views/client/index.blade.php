@extends('adminlte::page')

@section('title', 'clients')

@section('content_header')
<h1>Clients</h1>
@stop

@section('content')
<div class="col-12">
  <div class="card">
    <div class="card-body table-responsive p-0">
      <table class="table table-hover table-bordered">
        <thead>
          <tr>
            <th>@lang('common.name')</th>
            <th>@lang('common.work_time')</th>
            <th>@lang('common.est_time')</th>
            <th>@lang('common.est_price')</th>
            <th>@lang('common.profit_time')</th>
            <th>@lang('common.profit_price')</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($clients as $client)
          <tr>
            <td>{{ $client->name }}</td>
            <td>{{ round($client->sum_work_time, 1) }}h</td>
            <td>{{ round($client->sum_est_time, 1) }}h</td>
            <td>￥{{ round($client->sum_est_price/10000, 1) }}万</td>
            <td>{{ round($client->sum_profit_time, 1) }}h</td>
            <td>￥{{ round($client->sum_profit_price/10000, 1) }}万</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@stop


@section('css')
<style>
</style>
@stop

@section('js')
<script>
</script>
@stop
@section('content')

@endsection
