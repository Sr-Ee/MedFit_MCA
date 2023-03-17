<!DOCTYPE html>
<html>
<head>
  <title>Nutrition Analysis</title>
</head>
<body>
  <form method="POST">
    <label for="food">Enter a food name:</label>
    <input type="text" id="food" name="food">
    <button type="submit">Analyze</button>
  </form>
  <div id="result">
    <?php
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $food = $_POST['food'];
        $appId = '7e7b03f9'; // replace with your actual app ID
        $appKey = '041b32ecb52535426dc5b0abbd9e0309'; // replace with your actual app key
        $url = "https://api.edamam.com/api/nutrition-data?app_id={$appId}&app_key={$appKey}&ingr={$food}";
        $data = file_get_contents($url);
        $nutrients = json_decode($data, true)['totalNutrients'];
        echo '<ul>';
        foreach ($nutrients as $nutrient) {
          echo "<li>{$nutrient['label']}: {$nutrient['quantity']}{$nutrient['unit']}</li>";
        }
        echo '</ul>';
      }
    ?>
  </div>
</body>
</html>
