<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customizable Workout Generator</title>
    <link rel="stylesheet" href="workout_styles.css">
</head>
<style>
  body {
    background: linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab);
    background-size: 400% 400%;
    animation: gradient 15s ease infinite;
    height: 100vh;
  }

  @keyframes gradient {
    0% {
      background-position: 0% 50%;
    }

    50% {
      background-position: 100% 50%;
    }

    100% {
      background-position: 0% 50%;
    }
  }

 
  .card {
    margin-bottom: 25px;
    margin-right: 37px;
    transition: transform .2s;

  }

  .card:hover {
    transform: scale(1.1);
    cursor: pointer;
  }

  .btn {
    display: block;
    margin: 0 auto;
  }

  .session-details {
    font-size: 20px;
    color: white;
    position: relative;
    right: 36px;
  }
</style>
<body>
    <div class="container">
        <h1>Customizable Workout Generator</h1>

        <div class="customize-section">
            <label for="exerciseCount">Number of Exercises:</label>
            <input type="number" id="exerciseCount" value="3">

            <label for="exerciseDuration">Duration per Exercise (in seconds):</label>
            <input type="number" id="exerciseDuration" value="30">

            <label for="totalDuration">Total Workout Duration (in minutes):</label>
            <input type="number" id="totalDuration" value="15">
        </div>

        <button onclick="generateCustomWorkout()">Generate Custom Workout</button>

        <div class="workout-result" id="workoutResult"></div>

        <!-- Add a new section for Calorie Counter -->
        <div class="calorie-counter">
            <h2>Calorie Counter</h2>
            <label for="userWeight">Your Weight (in kg):</label>
            <input type="number" id="userWeight" value="70">
            <button onclick="calculateCalories()">Calculate Calories</button>
            <p id="calorieResult"></p>
        </div>

    </div>
    <script src="workout_script.js"></script>
</body>

</html>