
<?php
// Connection to the database
$host="sql107.epizy.com"; // Host name 
$username="epiz_23723207"; // Mysql username 
$password="7wdNnO2iJ5I"; // Mysql password 
$db_name="epiz_23723207_CampingFood"; // Database name 




// Connect to server and select databse.
$conn = mysqli_connect($host, $username, $password, $db_name)or die("cannot connect"); 
// mysqli_select_db("$db_name")or die("cannot select DataBase");

/*

if(isset($_POST['checkbox'])){$checkbox = $_POST['checkbox'];
if(isset($_POST['activate'])?$activate = $_POST["activate"]:$deactivate = $_POST["deactivate"])
$id = "('" . implode( "','", $checkbox ) . "');" ;
$sql="UPDATE FoodOptions SET IncludeThisTrip = '".(isset($activate)?'Y':'N')."' WHERE Meal IN $id" ;
$result = mysqli_query($sql) or die(mysqli_error());
}
 */


if($_POST["hidquery"] == "t") {

    $sql = "UPDATE FoodOptions SET IncludeThisTrip = NULL";
    mysqli_query($conn, $sql);
      
    $qty = $_POST["chkmeal"];
    foreach($qty as $value) {
        $sql = "UPDATE FoodOptions SET IncludeThisTrip = 1 WHERE Meal = '" . $value . "'";
        mysqli_query($conn, $sql);
    };
    
    header("Location: SuppliesNeeded.php"); /* Redirect browser */
    exit();
};


$sql = "SELECT * FROM FoodOptions ORDER BY MealType,Meal";
$result = mysqli_query($conn, $sql);
$count = mysqli_num_rows($result);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset="utf-8"" />
<title>Camping Food Selection</title>


</head>
<body>
<br><a href="http://campingoptions.epizy.com/SuppliesNeeded.php">Supplies Needed List</a></br>

<table width="400" border="0" cellspacing="1" cellpadding="0">
<tr>
<td><form name="frmactive" method="post" action="">
<table width="400" border="0" cellpadding="3" cellspacing="1">
<tr>
<!-- <td align="center"><input type="checkbox" name="allbox" title="Select or Deselect ALL" style="background-color:#ccc;"/></td> -->
<td align="center"><strong>IncludeThisTrip</strong></td>
<td align="center"><strong>MealType</strong></td>
<td align="center"><strong>Meal</strong></td>
</tr>

<?php
while($rows=mysqli_fetch_array($result)){
?> 
<tr>
<td><input type="checkbox" name="chkmeal[]" value="<? echo $rows['Meal']; ?>" /></td>
<td><? echo $rows['MealType']; ?></td>
<td><? echo $rows['Meal']; ?></td>
</tr>
<?php
}
?>

<tr>
<td colspan="5" align="center">&nbsp;</td>
</tr>
</table>
<input type="hidden" name="hidquery" value="t" />
<input type="submit" value="Submit this List" /><br />


</form>
</td>
</tr>
</table>
</body>
</html>
