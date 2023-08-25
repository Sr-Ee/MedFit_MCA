document.addEventListener("DOMContentLoaded", function() {
    const saveTokenButton = document.getElementById("saveTokenButton");
    const fetchDataButton = document.getElementById("fetchDataButton");
    const dateInput = document.getElementById("dateInput");
    const heartRateDataDiv = document.getElementById("heartRateData");

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
        const apiUrl = `https://api.fitbit.com/1/user/-/activities/heart/date/${selectedDate}/1d.json`;

        const options = {
            headers: {
                'Authorization': 'Bearer ' + accessToken
            }
        };

        fetch(apiUrl, options)
            .then(response => response.json())
            .then(data => {
                const heartRateActivities = data['activities-heart'];

                if (heartRateActivities.length > 0) {
                    const dateTime = heartRateActivities[0].dateTime;
                    const heartRateZones = heartRateActivities[0].value.heartRateZones;

                    let heartRateDataHtml = `<h2>Heart Rate Data for ${dateTime}</h2>`;
                    heartRateDataHtml += '<ul>';
                    heartRateZones.forEach(zone => {
                        heartRateDataHtml += `<li>${zone.name}: ${zone.min}-${zone.max} bpm</li>`;
                    });
                    heartRateDataHtml += '</ul>';

                    heartRateDataDiv.innerHTML = heartRateDataHtml;
                } else {
                    heartRateDataDiv.innerHTML = "<p>No heart rate data available for the selected date.</p>";
                }
            })
            .catch(err => {
                console.error(err);
                heartRateDataDiv.innerHTML = "<p>Error fetching heart rate data.</p>";
            });
    });
});