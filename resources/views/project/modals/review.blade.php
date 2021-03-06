{{-- modal --}}
<div class="modal fade" id="review-modal" tabindex="-1" role="dialog" aria-labelledby="review-modal-label"
  aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="review-modal-label">
          {{ $project->name }}
          <small>のレビュー</small>
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="{{ route('review.updateOrCreate') }}">
        @csrf
        @method('post')
        <div class="modal-body">
          <table class="table table-bordered sticky_table">
            <tbody class="text-nowrap">
              <input type="hidden" id="project_id" name="project_id" value="">
              <input type="hidden" id="id" name="id" value="">
              <tr>
                <th class="edit-thead">自己評価ユーザー</th>
                <td>
                  {{  Form::select('self_user_id', $users, [],['id' => 'self_user']) }}
                </td>
              </tr>
              <tr>
                <th>自己評価</th>
                <td>
                  <textarea name="self_comment" id="self_comment" rows="8"></textarea>
                </td>
              </tr>
              <tr>
                <th class="edit-thead">他者評価ユーザー</th>
                <td>
                  {{ Form::select('other_user_id', $users, [], ['id' => 'other_user']) }}
                </td>
              </tr>
              <tr>
                <th>他者評価</th>
                <td>
                  <textarea name="other_comment" id="other_comment" rows="8"></textarea>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="modal-footer">
          <button name="is_save" value="false" type="submit" class="btn btn-danger mr-auto">プロジェクトを終了する</button>
          <button name="is_save" value="true" type="submit" class="btn btn-primary">一時保存</button>
        </div>
      </form>
    </div>
  </div>
</div>
{{-- modal --}}
