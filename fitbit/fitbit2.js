const accessToken = 'eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiIyMzhaU1ciLCJzdWIiOiI5UDRKM00iLCJpc3MiOiJGaXRiaXQiLCJ0eXAiOiJhY2Nlc3NfdG9rZW4iLCJzY29wZXMiOiJyc29jIHJlY2cgcnNldCByb3h5IHJwcm8gcm51dCByc2xlIHJjZiByYWN0IHJyZXMgcmxvYyByd2VpIHJociBydGVtIiwiZXhwIjoxNjc1MjAzNDU1LCJpYXQiOjE2NzUxNzQ2NTV9.54eJiYUcmPlhczVqek0Z7aGuJZ_BHfpJeIpeYeknjIE';
const options = {
    headers: {
        'Authorization': 'Bearer ' + accessToken
    }
};

fetch('https://api.fitbit.com/1/user/-/activities/goals/daily.json', options)
    .then(response => response.json())
    .then((data) => {
        console.log(data);
        const { activeMinutes, caloriesOut, distance, floors, steps } = data.goals;
        document.getElementById('activeMinutes').innerHTML = activeMinutes;
        document.getElementById('caloriesOut').innerHTML = caloriesOut;
        document.getElementById('distance').innerHTML = distance;
        document.getElementById('floors').innerHTML = floors;
        document.getElementById('steps').innerHTML = steps;
    })
    .catch(err => console.error(err));
