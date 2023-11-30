const exercises = [
    'Jumping Jacks',
    'Push-ups',
    'Squats',
    'Plank',
    'Lunges',
    'High Knees',
    'Burpees',
    'Mountain Climbers',
    'Tricep Dips',
    'Bicycle Crunches'
  ];
  
  function generateCustomWorkout() {
    const exerciseCount = document.getElementById('exerciseCount').value;
    const exerciseDuration = document.getElementById('exerciseDuration').value;
    const totalDuration = document.getElementById('totalDuration').value;
  
    const workoutResult = document.getElementById('workoutResult');
    const workoutHistory = document.getElementById('historyList');
  
    // Generate custom workout
    const customWorkout = generateWorkoutList(exerciseCount, exerciseDuration);
    
    // Display the custom workout
    workoutResult.innerHTML = `<h2>Your Custom Workout:</h2>${customWorkout}`;
  
    // Log the workout in history
    logWorkout(customWorkout, workoutHistory);
  
    // Clear input fields
    clearInputFields();
  }
  
  function generateWorkoutList(exerciseCount, exerciseDuration) {
    let workoutList = '<ul>';
    for (let i = 1; i <= exerciseCount; i++) {
      const exercise = getRandomExercise();
      workoutList += `<li>${i}. ${exercise} - ${exerciseDuration} seconds</li>`;
    }
    workoutList += '</ul>';
    return workoutList;
  }
  
  function getRandomExercise() {
    const randomIndex = Math.floor(Math.random() * exercises.length);
    return exercises[randomIndex];
  }
  
  function logWorkout(workout, historyList) {
    const currentDate = new Date();
    const formattedDate = `${currentDate.toLocaleDateString()} ${currentDate.toLocaleTimeString()}`;
    const workoutItem = `<li>${formattedDate}: ${workout}</li>`;
    historyList.innerHTML += workoutItem;
  }
  
  function clearInputFields() {
    document.getElementById('exerciseCount').value = '3';
    document.getElementById('exerciseDuration').value = '30';
    document.getElementById('totalDuration').value = '15';
  }
  
  // Add a function to calculate calories
  function calculateCalories() {
    const userWeight = document.getElementById('userWeight').value;
    const exerciseCount = document.getElementById('exerciseCount').value;
    const exerciseDuration = document.getElementById('exerciseDuration').value;
  
    // Assume a basic calculation: Calories burned per minute = weight in kg * MET (Metabolic Equivalent of Task)
    // MET varies based on exercise intensity; here we use a basic estimate for illustration purposes
    const metValues = {
      'Jumping Jacks': 8,
      'Push-ups': 3,
      'Squats': 5,
      'Plank': 2,
      'Lunges': 6,
      'High Knees': 10,
      'Burpees': 12,
      'Mountain Climbers': 9,
      'Tricep Dips': 3,
      'Bicycle Crunches': 8
    };
  
    const exerciseMet = metValues[getRandomExercise()] || 5; // Use 5 as a default MET value if exercise is not found
  
    // Calculate calories burned: Calories = MET * weight (kg) * duration (minutes)
    const caloriesBurned = exerciseMet * userWeight * (exerciseDuration / 60);
  
    // Display the result
    const calorieResult = document.getElementById('calorieResult');
    calorieResult.textContent = `Estimated Calories to be Burned: ${caloriesBurned.toFixed(2)} calories`;
  }
  