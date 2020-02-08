{{-- modal --}}
<div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="edit-modal-label"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="edit-modal-label">新メッセージ</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="{{ route('project.update') }}">
        @csrf
        @method('put')
        <div class="modal-body">
          <table class="table table-bordered sticky_table">
            <tbody>
              <input type="hidden" name="id" id="id">
              <tr>
                <th>見積工数</th>
                <td><input type="number" step="0.1" name="est_time" class="form-control" id="est_time" min="0"></td>
              </tr>
              <tr>
                <th>見積金額<small>(提出した額)</small></th>
                <td><input type="number" name="est_price" class="form-control" id="est_price" min="0"></td>
              </tr>
              <tr>
                <th>外注費</th>
                <td><input type="number" name="out_price" class="form-control" id="out_price" min="0"></td>
              </tr>
              <tr>
                <th>単価</th>
                <td><input type="number" name="unit_price" class="form-control" id="unit_price" min="1"></td>
              </tr>
              <tr>
                <th>進捗</th>
                <td><input type="number" name="progress" min="0" max="100" class="form-control" id="progress"></td>
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
