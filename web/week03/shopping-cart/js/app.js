 jQuery(document).ready(function() {
    jQuery(".openModal").click(function(e) {
      let itemId = $(this).data("itemid");
      e.preventDefault();
      jQuery.ajax({
            url: 'browse_item.php', 
            type: 'POST', 
            data: itemId,
            success: function(data){
              $("#productModal").modal("show")
            }
        });
      //$("#productModal").modal("show");
    });
  });