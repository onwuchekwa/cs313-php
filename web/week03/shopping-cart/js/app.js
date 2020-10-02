  $(document).ready(function() {
    $('#productModal').on('show.bs.modal', function(e) {
        var itemId = $(e.relatedTarget).data('itemcode');
        $(e.currentTarget).find('input[name="item_id"]').val(itemId);
    });
  });