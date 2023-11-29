const form = document.querySelector('form');
const resultDiv = document.querySelector('#result');
const appId = '78221b89'; // replace with your actual app ID
const appKey = '89ec75c387f70b66be70eea93559aaae'; // replace with your actual app key

form.addEventListener('submit', async (event) => {
  event.preventDefault();
  const food = form.food.value;
  const response = await fetch(`https://api.edamam.com/api/nutrition-data?app_id=${appId}&app_key=${appKey}&ingr=${food}`);
  const data = await response.json();
  const nutrients = data.totalNutrients;
  let html = '<ul>';
  for (let nutrient in nutrients) {
    html += `<li>${nutrients[nutrient].label}: ${nutrients[nutrient].quantity.toFixed(2)}${nutrients[nutrient].unit}</li>`;
  }
  html += '</ul>';
  resultDiv.innerHTML = `
    <h4>${food}</h4>
    ${html}
  `;
});
