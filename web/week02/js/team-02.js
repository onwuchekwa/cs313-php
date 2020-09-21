// Vanilla JavaScript

// Get unique elements
const getElementId = (id) => {
    return document.querySelector(id);
}

// Make div text title case
const changeCase = (colorName)  => {
    return colorName.charAt(0).toUpperCase() + colorName.slice(1).toLowerCase();
 }

const btnClicked = getElementId("#alertClicked");
const firstDiv = getElementId("#firstDiv");
const colorText = getElementId("#colorText");
const changeColor = getElementId("#changeColor")
const errorMessage = getElementId(".errorMessage");

// Validate colorText
const validateColorText = () => {
    let errorMsg = "";
    let elementId = "";

    // Check if colorText field is empty
    if(colorText.validity.valueMissing) {
        errorMsg = errorMsg + errorMessage.innerHTML + "<br>";
        colorText.nextElementSibling.style.display = "block";
        if(elementId == "") {
            elementId = colorText;
        }
        elementId.focus();
    } else {
        colorText.nextElementSibling.style.display = "none";
    }
     // Check if error message is empty
     if(errorMsg != "") {
        return false;
    } else {
        return true;
    }
}

// Hide error message
errorMessage.style.display = "none";

// Add click event listner to "Click Me" button
btnClicked.addEventListener('click', () => {
    alert("Clicked!");
});

// Add click event listner to "Change color" button
changeColor.addEventListener('click', () => {
    if (validateColorText()) {
        firstDiv.style.backgroundColor = colorText.value;
        firstDiv.innerHTML = changeCase(colorText.value); 
    }
});

// Add change listener to colorText fields
colorText.addEventListener('change', () => validateColorText());
