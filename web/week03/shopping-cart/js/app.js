  $(document).ready(function() {
    $(".openModal").click(function(e) {
      let itemId = $(this).data("itemid");
      e.preventDefault();
        $.ajax({
            type: 'POST',
            data: {itemCode: itemId},
            success: function(data){
              $("#productModal").modal("show");
              alert(data);
            }
        });
      //$("#productModal").modal("show");
    });
  });