document.addEventListener("DOMContentLoaded", function() {
    const saveTokenButton = document.getElementById("saveTokenButton");
    const fetchDataButton = document.getElementById("fetchDataButton");
    const dateInput = document.getElementById("dateInput");
    const heartRateDataDiv = document.getElementById("heartRateData");
    const heartRateChartCanvas = document.getElementById("heartRateChart");

    // ...

    fetchDataButton.addEventListener("click", function() {
        // ...

        fetch(apiUrl, options)
            .then(response => response.json())
            .then(data => {
                // ...

                if (heartRateActivities.length > 0) {
                    // ...

                    // Create an array of labels and data for Chart.js
                    const labels = heartRateZones.map(zone => zone.name);
                    const data = heartRateZones.map(zone => ({
                        min: zone.min,
                        max: zone.max
                    }));

                    // Render the Chart.js chart
                    renderChart(labels, data);
                } else {
                    heartRateDataDiv.innerHTML = "<p>No heart rate data available for the selected date.</p>";
                }
            })
            .catch(err => {
                console.error(err);
                heartRateDataDiv.innerHTML = "<p>Error fetching heart rate data.</p>";
            });
    });

    function renderChart(labels, data) {
        const ctx = heartRateChartCanvas.getContext("2d");

        const chartData = {
            labels: labels,
            datasets: [{
                label: 'Heart Rate Zones (bpm)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1,
                data: data,
            }]
        };

        const chartOptions = {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        };

        new Chart(ctx, {
            type: 'bar',
            data: chartData,
            options: chartOptions
        });
    }
});
