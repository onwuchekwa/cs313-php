$(document).ready(function() {
    function manageCart(action, itemCode) {
        let quertString = "";
        if(action != "") {
            switch(action) {
                case "add":
                    quertString = "action=" + action + "&itemCode=" + itemCode + "&quantity=" + $("#quantity_" + itemCode).val();
                    break;
    
                case "remove":
                    quertString = "action=" + action + "&itemCode=" + itemCode;
                    break;
                    
                case "empty":
                    quertString = "action=" + action;
                    break;
            }
        }
    
        $.ajax({
            url: "../ajax-action",
            data: quertString,
            type: "POST",
            success: function(data) {
                $("#cartItems").html(data);
                if(action == "add") {
                    $("#add_" + itemCode + " img").attr("src", "images/icon-check.png");
                    $("#add_" + itemCode).attr("onclick", "");
                }
            }
        })
    }
});
