document.addEventListener('DOMContentLoaded', () => {
    const fetchDataButton = document.getElementById('fetchData');
    fetchDataButton.addEventListener('click', fetchData);

    async function fetchData() {
        const startDate = document.getElementById('startDate').value;
        const endDate = document.getElementById('endDate').value;

        const apiUrl = `https://api.fitbit.com/1/user/-/activities/steps/date/${startDate}/${endDate}.json`;

        function displayData(stepsData) {
            const dataTableBody = document.querySelector('#dataTable tbody');
            dataTableBody.innerHTML = '';
    
            stepsData.forEach(entry => {
                const row = document.createElement('tr');
                const dateCell = document.createElement('td');
                dateCell.textContent = entry.dateTime;
                const stepsCell = document.createElement('td');
                stepsCell.textContent = entry.value;
    
                row.appendChild(dateCell);
                row.appendChild(stepsCell);
                dataTableBody.appendChild(row);
            });
        }
        try {
            const response = await fetch(apiUrl, {
                headers: {
                    'Authorization': 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiIyMzhaU1ciLCJzdWIiOiI5UDRKM00iLCJpc3MiOiJGaXRiaXQiLCJ0eXAiOiJhY2Nlc3NfdG9rZW4iLCJzY29wZXMiOiJyc29jIHJlY2cgcnNldCByb3h5IHJwcm8gcm51dCByc2xlIHJjZiByYWN0IHJyZXMgcmxvYyByd2VpIHJociBydGVtIiwiZXhwIjoxNjkyODAyMTkwLCJpYXQiOjE2OTI3NzMzOTB9.WFZ8tjOgcDADkq5puZukkP8VRmaKgKCFAJ3Hg5J23QQ' // Replace with your Fitbit access token
                }
            });

            if (response.ok) {
                const data = await response.json();
                displayData(data['activities-steps']);
            } else {
                console.error('Error fetching data');
            }
        } catch (error) {
            console.error('An error occurred:', error);
        }
    }

    
});
