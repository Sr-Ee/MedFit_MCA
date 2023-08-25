document.addEventListener("DOMContentLoaded", function() {
    const saveTokenButton = document.getElementById("saveTokenButton");
    const fetchDataButton = document.getElementById("fetchDataButton");
    const dateInput = document.getElementById("dateInput");
    const activityDataDiv = document.getElementById("activityData");

    saveTokenButton.addEventListener("click", function() {
        const accessToken = document.getElementById("accessTokenInput").value;
        if (accessToken.trim() !== "") {
            localStorage.setItem("fitbitAccessToken", accessToken);
            alert("Access token saved!");
        } else {
            alert("Please enter a valid access token.");
        }
    });

    fetchDataButton.addEventListener("click", function() {
        const accessToken = localStorage.getItem("fitbitAccessToken"); // Retrieve access token from local storage

        if (!accessToken) {
            alert("Please enter and save your access token first.");
            return;
        }

        const selectedDate = dateInput.value;
        const apiUrl = `https://api.fitbit.com/1/user/-/activities/steps/date/${selectedDate}/7d.json`;

        const options = {
            headers: {
                'Authorization': 'Bearer ' + accessToken
            }
        };

        fetch(apiUrl, options)
            .then(response => response.json())
            .then(data => {
                const activitySteps = data['activities-steps'];

                if (activitySteps.length > 0) {
                    let activityDataHtml = '<h2>Activity Data</h2>';
                    activityDataHtml += '<ul>';
                    activitySteps.forEach(activity => {
                        const dateTime = activity.dateTime;
                        const steps = activity.value;

                        activityDataHtml += `<li>Date: ${dateTime}, Steps: ${steps}</li>`;
                    });
                    activityDataHtml += '</ul>';

                    activityDataDiv.innerHTML = activityDataHtml;
                } else {
                    activityDataDiv.innerHTML = "<p>No activity data available for the selected date range.</p>";
                }
            })
            .catch(err => {
                console.error(err);
                activityDataDiv.innerHTML = "<p>Error fetching activity data.</p>";
            });
    });
});