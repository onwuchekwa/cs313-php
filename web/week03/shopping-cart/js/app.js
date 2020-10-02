  $(document).ready(function() {
    $(".openModal").click(function(e) {
      let itemId = $(this).data("itemid");
      e.preventDefault();
        $.ajax({
            type: 'GET',
            data: {itemCode: itemId},
            success: function(data){
              $("#productModal").modal("show");
              $('#itemCode').val(data.itemCode);
            }
        });
      //$("#productModal").modal("show");
    });
  });