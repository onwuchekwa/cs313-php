  $(document).ready(function() {
    $(".openModal").click(function(e) {
      let itemId = $(this).data("itemid");
      e.preventDefault();
        $.ajax({
            type: 'GET',
            data: JSON.stringify({itemCode: itemId}),
            success: function(data){
              $("#productModal").modal("show");
              alert(data.itemCode);
            }
        });
      //$("#productModal").modal("show");
    });
  });