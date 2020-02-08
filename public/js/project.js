$('#edit-modal').on('show.bs.modal', function (event) {
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
    modal.find('.modal-title').text(name)
    modal.find('.modal-body #id').val(id)
    modal.find('.modal-body #est_time').val(est_time)
    modal.find('.modal-body #est_price').val(est_price)
    modal.find('.modal-body #out_price').val(out_price)
    modal.find('.modal-body #unit_price').val(unit_price)
    modal.find('.modal-body #progress').val(progress)
    if (is_skip_rank === 1) {
      is_skip_rank = true;
    }else{
      is_skip_rank = false;
    }
    modal.find('.modal-body #is_skip_rank').prop('checked',is_skip_rank)
  })
