window.onload = function() {
    const dateInput = document.getElementById('forecast_date');
    // set minimum date to today
    dateInput.min = new Date().toISOString().split("T")[0];
    // set maximum date to 5 days from today
    const maxDate = new Date();
    maxDate.setDate(maxDate.getDate() + 5);
    dateInput.max = maxDate.toISOString().split("T")[0];
}