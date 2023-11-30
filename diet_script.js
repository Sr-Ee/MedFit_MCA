// Add a function to generate a diet plan
function generateDietPlan() {
    const userAge = document.getElementById('userAge').value;
    const userGender = document.getElementById('userGender').value;
    const userActivityLevel = document.getElementById('userActivityLevel').value;
  
    // You should replace 'YOUR_APP_ID' and 'YOUR_APP_KEY' with your Edamam API credentials
    const appId = 'af21a373';
    const appKey = '2f1cb4fb52d68452de2dbb0d80742cf5';
    const apiEndpoint = 'https://api.edamam.com/api/nutrition-details';
  
    // Assume a basic meal plan; you can customize this based on more complex logic
    const dietPlan = getBasicDietPlan(userAge, userGender, userActivityLevel);
  
    // Display the diet plan
    const dietPlanElement = document.getElementById('dietPlan');
    dietPlanElement.textContent = dietPlan;
  
    // Example: Make a call to the Edamam API for nutrition analysis
    // This requires a server-side implementation to keep your API key secure
    fetch(apiEndpoint, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({
        ingr: dietPlan.ingredients,
        appId,
        appKey,
      }),
    })
    .then(response => response.json())
    .then(data => {
      console.log('Nutrition Analysis:', data);
    })
    .catch(error => console.error('Error:', error));
  
  }
  
  // Add a function to generate a basic diet plan
  function getBasicDietPlan(age, gender, activityLevel) {
    // Basic diet plan logic (replace with more sophisticated logic based on your requirements)
    let dietPlan = '';
  
    if (age < 30) {
      dietPlan += 'Breakfast: Avocado Toast\n';
      dietPlan += 'Lunch: Quinoa Salad\n';
      dietPlan += 'Dinner: Grilled Chicken with Veggies\n';
    } else {
      dietPlan += 'Breakfast: Greek Yogurt with Berries\n';
      dietPlan += 'Lunch: Salmon and Brown Rice\n';
      dietPlan += 'Dinner: Stir-fried Tofu with Broccoli\n';
    }
  
    // Modify the plan based on gender
    if (gender === 'female') {
      dietPlan += 'Snack: Almonds and an Apple\n';
    } else {
      dietPlan += 'Snack: Protein Shake\n';
    }
  
    // Adjust the plan based on activity level
    switch (activityLevel) {
      case 'sedentary':
        dietPlan += 'Snack: Carrot Sticks\n';
        break;
      case 'moderate':
        dietPlan += 'Snack: Hummus with Whole Wheat Crackers\n';
        break;
      case 'active':
        dietPlan += 'Snack: Trail Mix\n';
        break;
      default:
        break;
    }
  
    return dietPlan;
  }
  