document.addEventListener("DOMContentLoaded", function() {
    const saveTokenButton = document.getElementById("saveTokenButton");
    const fetchDataButton = document.getElementById("fetchDataButton");
    const startDateInput = document.getElementById("startDateInput");
    const endDateInput = document.getElementById("endDateInput");
    const cardioScoreDataDiv = document.getElementById("cardioScoreData");

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

        const startDate = startDateInput.value;
        const endDate = endDateInput.value;
        const apiUrl = `https://api.fitbit.com/1/user/-/cardioscore/date/${startDate}/${endDate}.json`;

        const options = {
            headers: {
                'Authorization': 'Bearer ' + accessToken
            }
        };

        fetch(apiUrl, options)
            .then(response => response.json())
            .then(data => {
                const cardioScoreData = data.cardioScore;

                if (cardioScoreData.length > 0) {
                    let cardioScoreDataHtml = '<h2>Cardio Score Data</h2>';
                    cardioScoreDataHtml += '<ul>';
                    cardioScoreData.forEach(score => {
                        const dateTime = score.dateTime;
                        const vo2Max = score.value.vo2Max;

                        cardioScoreDataHtml += `<li>Date: ${dateTime}, VO2 Max: ${vo2Max}</li>`;
                    });
                    cardioScoreDataHtml += '</ul>';

                    cardioScoreDataDiv.innerHTML = cardioScoreDataHtml;
                } else {
                    cardioScoreDataDiv.innerHTML = "<p>No cardio score data available for the selected date range.</p>";
                }
            })
            .catch(err => {
                console.error(err);
                cardioScoreDataDiv.innerHTML = "<p>Error fetching cardio score data.</p>";
            });
    });
});