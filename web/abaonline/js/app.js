//Date function
function getFullDate() {
    const monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
    const dt = new Date();
    const date = dt.getDate();
    const monthName = monthNames[dt.getMonth()];
    const fullYear = dt.getFullYear();
    const date_value = `${date} ${monthName}, ${fullYear}`;
    return date_value;
}

// Footer Date
document.getElementById("lastUpdated").innerHTML = getFullDate();