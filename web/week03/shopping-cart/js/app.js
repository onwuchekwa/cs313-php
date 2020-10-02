  $(document).ready(function() {
    $(".openModal").click(function(e) {
      let itemId = $(this).data("itemid");
      e.preventDefault();
        $.ajax({
            url: 'browse_item.php', 
            dataType: 'json', 
            type: 'POST', 
            data: JSON.stringify({"itemId": itemId}),
            //data: {"itemId": itemId},
            success: function(data){
              $("#productModal").modal("show");
              $('#itemCode').val(data.itemId);
            }
            }
        });
      //$("#productModal").modal("show");
    });
  });