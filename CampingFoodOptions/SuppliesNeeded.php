<?php

$servername		= "sql107.epizy.com"; // Use Local Host Only      
$username	= "epiz_23723207";
$password	= "7wdNnO2iJ5I"; 
$database	= "epiz_23723207_CampingFood"; 
 
$link = mysqli_connect($servername, $username, $password, $database);
 
if (!$link) {
 echo "Connection Error". PHP_EOL;
 echo "Error Code: ". mysqli_connect_errno().PHP_EOL;
 echo "Error: Description".mysqli_connect_error().PHP_EOL;
 exit;
}
echo "Connection is Successful";
echo "<br />";


$sql = "SELECT IngredientsNeeded FROM FoodOptions fo
	INNER JOIN RecipeNeeds rn on fo.Meal = rn.Meal
WHERE fo.IncludeThisTrip = 1 and CoolerItem = 'Non-Cooler'
GROUP BY IngredientsNeeded
ORDER BY IngredientsNeeded";

$result = mysqli_query($link, $sql);

if (!$result) {
    echo "<br />error: " . mysqli_error($link);
}


if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo "<br />Food - Non-Cooler: " . $row["IngredientsNeeded"];
    }
} else {
    echo "<br />0 results";
}


echo "<br />";

$sql = "SELECT IngredientsNeeded FROM FoodOptions fo
	INNER JOIN RecipeNeeds rn on fo.Meal = rn.Meal
WHERE fo.IncludeThisTrip = 1 and CoolerItem = 'Cooler'
GROUP BY IngredientsNeeded
ORDER BY IngredientsNeeded";

$result = mysqli_query($link, $sql);

if (!$result) {
    echo "<br />error: " . mysqli_error($link);
}


if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo "<br />Food - Cooler Items: " . $row["IngredientsNeeded"];
    }
} else {
    echo "<br />0 results";
}


echo "<br />";

$sql = "SELECT SuppliesNeeded FROM FoodOptions fo
	        INNER JOIN KitchenSupplyNeeds rn on fo.Meal = rn.Meal
        WHERE fo.IncludeThisTrip = 1
        GROUP BY SuppliesNeeded
    UNION ALL 
    SELECT 'Cutting Board' as SuppliesNeeded UNION ALL 
    SELECT 'Kettle' as SuppliesNeeded UNION ALL 
    SELECT 'Hot Pads' as SuppliesNeeded UNION ALL 
    SELECT '3 Kitchen Towels' as SuppliesNeeded UNION ALL
    SELECT '1 Kitchen Rags' as SuppliesNeeded  UNION ALL
    SELECT 'Lighter' as SuppliesNeeded  UNION ALL
    SELECT 'Hydration Packs' as SuppliesNeeded
    ORDER BY SuppliesNeeded";

$result = mysqli_query($link, $sql);

if (!$result) {
    echo "<br />error: " . mysqli_error($link);
}



if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo "<br />Supplies: " . $row["SuppliesNeeded"];
    }
} else {
    echo "<br />0 results";
}



echo "<br />";

$sql = "SELECT Meal, MealType FROM FoodOptions WHERE IncludeThisTrip = 1 ORDER BY MealType";

$result = mysqli_query($link, $sql);

if (!$result) {
    echo "<br />error: " . mysqli_error($link);
}



if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo "<br />Meals: " . $row["MealType"] . "-" . $row["Meal"];
    }
} else {
    echo "<br />0 results";
}



?>
