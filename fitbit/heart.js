document.addEventListener('DOMContentLoaded', function() {
    const fetchButton = document.getElementById('fetchButton');
    const startDateInput = document.getElementById('startDate');
    const endDateInput = document.getElementById('endDate');
    const dataTable = document.getElementById('dataTable');

    fetchButton.addEventListener('click', fetchData);

    async function fetchData() {
        const startDate = startDateInput.value;
        const endDate = endDateInput.value;
        
        if (!startDate || !endDate) {
            alert('Please select both start and end dates.');
            return;
        }

        const apiUrl = `https://api.fitbit.com/1/user/-/activities/heart/date/${startDate}/${endDate}.json`;

        try {
            const response = await fetch(apiUrl, {
                method: 'GET',
                headers: {
                    'Authorization': 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiIyMzhaU1ciLCJzdWIiOiI5UDRKM00iLCJpc3MiOiJGaXRiaXQiLCJ0eXAiOiJhY2Nlc3NfdG9rZW4iLCJzY29wZXMiOiJyc29jIHJlY2cgcnNldCByb3h5IHJwcm8gcm51dCByc2xlIHJjZiByYWN0IHJyZXMgcmxvYyByd2VpIHJociBydGVtIiwiZXhwIjoxNjkyODAyMTkwLCJpYXQiOjE2OTI3NzMzOTB9.WFZ8tjOgcDADkq5puZukkP8VRmaKgKCFAJ3Hg5J23QQ' // Replace with your Fitbit access token
                }
            });

            if (response.ok) {
                const data = await response.json();
                if (data && data['activities-heart']) {
                    displayData(data['activities-heart']);
                } else {
                    alert('No heart activity data found for the selected date range.');
                }
            } else {
                alert('Error fetching data from Fitbit API.');
            }
        } catch (error) {
            console.error('Error:', error);
        }
    }

    function displayData(data) {
        dataTable.innerHTML = ''; // Clear existing data

        const headerRow = document.createElement('tr');
        const headerDateCell = document.createElement('th');
        headerDateCell.textContent = 'Date';
        headerRow.appendChild(headerDateCell);

        const headerCells = ['Calories Out', 'Max HR', 'Min HR', 'Minutes', 'Resting HR'];
        headerCells.forEach(cellText => {
            const headerCell = document.createElement('th');
            headerCell.textContent = cellText;
            headerRow.appendChild(headerCell);
        });

        dataTable.appendChild(headerRow);

        data.forEach(entry => {
            const row = document.createElement('tr');
            const dateCell = document.createElement('td');
            dateCell.textContent = entry.dateTime;
            row.appendChild(dateCell);

            const value = entry.value;
            const heartRateZones = value.heartRateZones.find(zone => zone.name === 'Cardio');
            if (heartRateZones) {
                const zoneCells = ['caloriesOut', 'max', 'min', 'minutes', 'restingHeartRate'];
                zoneCells.forEach(zoneKey => {
                    const zoneCell = document.createElement('td');
                    zoneCell.textContent = heartRateZones[zoneKey];
                    row.appendChild(zoneCell);
                });

                dataTable.appendChild(row);
            }
        });
    }
});
