document.addEventListener("DOMContentLoaded", function () {
    // Ensure the DOM is fully loaded before accessing elements

    let form = document.forms[0];
    let submit = document.getElementById("input_submit");
    
    console.log(submit);

    submit.addEventListener("click", function (ev) {
        // Pass the event parameter to the function and prevent the default form submission
        ev.preventDefault();

        // Create a FormData object to collect form data
        let formData = new FormData(form);

        // Use the Fetch API to make an asynchronous request
        fetch("http://serverpedroerasmus/api/apiConvocatory.php", {
            method: "POST", // Change method to POST for form submissions
            body: formData
        })
        .then(response => {
            // Check if the response status is within the success range (200-299)
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json(); // Parse the response body as JSON
        })
        .then(jsonData => {
            console.log(jsonData);
            // Perform actions with the JSON data received from the server
        })
        .catch(error => {
            console.error('Error during fetch operation:', error);
            // Handle errors that occur during the fetch operation
        });
    });
});