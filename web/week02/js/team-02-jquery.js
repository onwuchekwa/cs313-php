// jQuery

$(document).ready(() => {
    const colorText = $('#colorText');

    const changeCase = (colorName)  => {
        return colorName.charAt(0).toUpperCase() + colorName.slice(1).toLowerCase();
     }

     $('.errorMessage').css('display', 'none');

    $('#alertClicked').click(() => {
        alert('Clicked');
    })

    const validateColorText = () => {
        let errorMsg = "";
    
        // Check if colorText field is empty
        if(colorText.val() == "") {
            errorMsg = $('.errorMessage').val() ;
            $('.errorMessage').css('display', 'block');
            colorText.focus();
        } else {
            $('.errorMessage').css('display', 'none');
        }
         // Check if error message is empty
         if(errorMsg != "") {
            return false;
        } else {
            return true;
        }
    }

    $('#changeColor').click(() => {
        if (validateColorText()) {
            $('#firstDiv').css('background-color', colorText.val());
            $('#firstDiv').text(changeCase(colorText.val()));
        }
    });
    
    // Add change listener to colorText fields
    colorText.change(() => validateColorText());   

    $('#changeVisibility').click(() => {
        $('#thirdDiv').fadeToggle(1000);
    })
});