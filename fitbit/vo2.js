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

        const apiUrl = `https://api.fitbit.com/1/user/-/cardioscore/date/${startDate}/${endDate}.json`;

        try {
            const response = await fetch(apiUrl, {
                method: 'GET',
                headers: {
                    'Authorization': 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiIyMzhaU1ciLCJzdWIiOiI5UDRKM00iLCJpc3MiOiJGaXRiaXQiLCJ0eXAiOiJhY2Nlc3NfdG9rZW4iLCJzY29wZXMiOiJyc29jIHJlY2cgcnNldCByb3h5IHJwcm8gcm51dCByc2xlIHJjZiByYWN0IHJyZXMgcmxvYyByd2VpIHJociBydGVtIiwiZXhwIjoxNjkyODAyMTkwLCJpYXQiOjE2OTI3NzMzOTB9.WFZ8tjOgcDADkq5puZukkP8VRmaKgKCFAJ3Hg5J23QQ' // Replace with your Fitbit access token
                }
            });

            if (response.ok) {
                const data = await response.json();
                if (data && data.cardioScore) {
                    displayData(data.cardioScore);
                } else {
                    alert('No cardio score data found for the selected date range.');
                }
            } else {
                alert('No Data Available for this interval.');
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

        const headerVo2MaxCell = document.createElement('th');
        headerVo2MaxCell.textContent = 'VO2 Max';
        headerRow.appendChild(headerVo2MaxCell);

        dataTable.appendChild(headerRow);

        data.forEach(entry => {
            const row = document.createElement('tr');
            const dateCell = document.createElement('td');
            dateCell.textContent = entry.dateTime;
            row.appendChild(dateCell);

            const vo2MaxCell = document.createElement('td');
            vo2MaxCell.textContent = entry.value.vo2Max;
            row.appendChild(vo2MaxCell);

            dataTable.appendChild(row);
        });
    }
});
