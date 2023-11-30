
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Fitness Hub</title>
  <link rel="stylesheet" href="diet_styles.css">
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
    <h1>Medfit - Fitness Hub</h1>
    
    <!-- ... Existing code for Customizable Workout Generator, Calorie Counter, Workout History, and Nutrition Tips ... -->

    <!-- New section for Diet Planner -->
    <div class="diet-planner">
      <h2>Diet Planner</h2>
      <label for="userAge">Your Age:</label>
      <input type="number" id="userAge" value="25">
      
      <label for="userGender">Your Gender:</label>
      <select id="userGender">
        <option value="male">Male</option>
        <option value="female">Female</option>
      </select>
      
      <label for="userActivityLevel">Your Activity Level:</label>
      <select id="userActivityLevel">
        <option value="sedentary">Sedentary</option>
        <option value="moderate">Moderate</option>
        <option value="active">Active</option>
      </select>

      <button onclick="generateDietPlan()">Generate Diet Plan</button>
      <p id="dietPlan"></p>
    </div>
  </div>
  <script src="diet_script.js"></script>
</body>
</html>
