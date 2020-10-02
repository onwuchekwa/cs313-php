  $(document).ready(function() {
    $(".openModal").click(function(e) {
      let itemId = $(this).data("itemid");
      e.preventDefault();
        $.ajax({
            url: 'browse_item.php?itemId=' + itemId, 
            type: 'GET', 
            data: itemId,
            success: function(data){
              $("#productModal").modal("show");
              alert(itemId);
            }
        });
      //$("#productModal").modal("show");
    });
  });