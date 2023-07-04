//const accessToken = 'eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiIyMzhaU1ciLCJzdWIiOiI5UDRKM00iLCJpc3MiOiJGaXRiaXQiLCJ0eXAiOiJhY2Nlc3NfdG9rZW4iLCJzY29wZXMiOiJyc29jIHJlY2cgcnNldCByb3h5IHJwcm8gcm51dCByc2xlIHJjZiByYWN0IHJyZXMgcmxvYyByd2VpIHJociBydGVtIiwiZXhwIjoxNjg4NTE3OTM2LCJpYXQiOjE2ODg0ODkxMzZ9.pybLTwfvj22GFT68zZ8xS0mN7z5nxe9Z0aE8OUPHt1E';
let options = {
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

fetch('https://api.fitbit.com/1/user/-/activities/heart/date/today/30d.json', options)
    .then(response => response.json())
    .then((data1) => {
        console.log(data1);
        const { "activities-heart": [{ value: { restingHeartRate, heartRateZones } }] } = data1;
        const { max, min } = heartRateZones.find(zone => zone.name === "Cardio");
        document.getElementById('restingHeartRate').innerHTML = restingHeartRate;
        document.getElementById('max').innerHTML = max;
        document.getElementById('min').innerHTML = min;
        console.log("Resting heart rate: " + restingHeartRate);
        console.log("Max heart rate: " + max);
        console.log("Min heart rate: " + min);
        
    })
    .catch(err => console.error(err));

fetch('https://api.fitbit.com/1/user/-/profile.json', options)
.then(response => {
  if (!response.ok) {
    throw new Error('Error retrieving profile data: ' + response.status);
  }
  return response.json();
})
.then(data => {
  console.log(data);
  const { user } = data;
  const { displayName, fullName, gender, height, weight, dateOfBirth,memberSince } = user;
  document.getElementById('full-name').innerHTML = fullName;
  document.getElementById('dob').innerHTML = dateOfBirth;
  document.getElementById('gender').innerHTML = gender;
  document.getElementById('height').innerHTML = height;
  document.getElementById('weight').innerHTML = weight;
  document.getElementById('mem-since').innerHTML = memberSince;
})
.catch(err => console.error(err));


document.getElementById('calculate-btn').addEventListener('click', () => {
  const spo2Date = document.getElementById("spo2-control").value;

  fetch(`https://api.fitbit.com/1/user/-/spo2/date/${spo2Date}.json`, options)
    .then(response => {
      if (!response.ok) {
        document.getElementById('spo2-min').innerText = 'No Data';
        document.getElementById('spo2-avg').innerText = 'No Data';
        document.getElementById('spo2-max').innerText = 'No Data';
      }
      return response.json();
    })
    .then(data => {
      console.log(data);
      const { value: { avg, min, max } } = data;
      document.getElementById('spo2-min').innerHTML = min;
      document.getElementById('spo2-avg').innerHTML = avg;
      document.getElementById('spo2-max').innerHTML = max;
    })
    .catch(err => console.error(err));
});

