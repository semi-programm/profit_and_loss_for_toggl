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
        <thead>
          <tr>
            <th>name</th>
            <th>latest</th>
            <th>sum_work_time</th>
            <th>est_time</th>
            <th>est_price</th>
            <th>unit_price</th>
            <th>progress</th>
            <th>profit_time</th>
            <th>profit_price</th>
            <th>out_price</th>
            <th>is_skip_rank</th>
            <th>remaining_time</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($projects as $project)
          <tr data-toggle="modal" data-target="#exampleModal" data-id="{{ $project->id }}"
            data-name="{{ $project->name }}" data-est_time="{{ $project->est_time }}"
            data-est_price="{{ $project->est_price }}" data-out_price="{{ $project->out_price }}"
            data-unit_price="{{ $project->unit_price }}" data-progress="{{ $project->progress }}"
            data-is_skip_rank="{{ $project->is_skip_rank }}">
            <td>
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
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

{{-- modal --}}
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">新メッセージ</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="{{ route('project.update', ['project' => $project->id]) }}">
        @csrf
        @method('put')
        <div class="modal-body">
          <table class="table table-bordered sticky_table">
            <tbody>
              <input type="hidden" name="id" id="id">
              <tr>
                <th>見積工数</th>
                <td><input type="number" name="est_time" class="form-control" id="est_time"></td>
              </tr>
              <tr>
                <th>見積金額<small>(提出した額)</small></th>
                <td><input type="number" name="est_price" class="form-control" id="est_price"></td>
              </tr>
              <tr>
                <th>外注費</th>
                <td><input type="number" name="out_price" class="form-control" id="out_price"></td>
              </tr>
              <tr>
                <th>単価</th>
                <td><input type="number" name="unit_price" class="form-control" id="unit_price"></td>
              </tr>
              <tr>
                <th>進捗</th>
                <td><input type="number" name="progress" class="form-control" id="progress"></td>
              </tr>
              <tr>
                <th>ランキングスキップ</th>
                <td><input type="checkbox" name="is_skip_rank" class="form-control" id="is_skip_rank" value="1"></td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">送信</button>
        </div>
      </form>
    </div>
  </div>
</div>
{{-- modal --}}
@stop


@section('css')
<style>
  .red{
    color: red;
  }
</style>
@stop

@section('js')
<script>
  $('#exampleModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // モーダル切替えボタン
  var id = button.data('id') // data-* 属性から情報を抽出
  var name = button.data('name')
  var est_time = button.data('est_time')
  var est_price = button.data('est_price')
  var out_price = button.data('out_price')
  var unit_price = button.data('unit_price')
  var progress = button.data('progress')
  var is_skip_rank = button.data('is_skip_rank')
  // 必要に応じて、ここでAJAXリクエストを開始可能（コールバックで更新することも可能）
  // モーダルの内容を更新。ここではjQueryを使用するが、代わりにデータ・バインディング・ライブラリまたは他のメソッドを使用することも可能
  var modal = $(this)
  modal.find('.modal-title').text(id + ':' + name)
  modal.find('.modal-body #id').val(id)
  modal.find('.modal-body #est_time').val(est_time)
  modal.find('.modal-body #est_price').val(est_price)
  modal.find('.modal-body #out_price').val(out_price)
  modal.find('.modal-body #unit_price').val(unit_price)
  modal.find('.modal-body #progress').val(progress)
  modal.find('.modal-body #is_skip_rank').val(is_skip_rank)
})
</script>
@stop
@section('content')

@endsection
