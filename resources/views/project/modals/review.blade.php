{{-- modal --}}
<div class="modal fade" id="review-modal" tabindex="-1" role="dialog" aria-labelledby="review-modal-label"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="review-modal-label">新メッセージ</h5>
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
              <input type="hidden" name="project_id">
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
