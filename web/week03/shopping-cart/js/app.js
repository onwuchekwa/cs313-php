  $(document).ready(function() {
    $(".openModal").click(function(e) {
      let itemId = $(this).data("itemid");
      e.preventDefault();
        $.ajax({
            type: 'POST',
            data: {itemCode: itemId},
            success: function(data){
              $("#productModal").modal("show");
              $('#itemCode').val(itemId);
            }
        });
      //$("#productModal").modal("show");
    });
  });