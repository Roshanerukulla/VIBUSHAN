
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'dbconnection.php';


$html = "<html><table style='width:100%' border='1px solid black'><tr>
    <th>dishname</th>
    <th>cuisine</th>
    <th>ingredients</th>
    <th>veg_or_nonveg</th>
  
  </tr>";


$sql = "SELECT dish_name, cuisine, ingredients, veg_or_nonveg FROM vibushan_menu";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
	    
	    while($row = mysqli_fetch_assoc($result)) {
			$html = $html."<tr><td>".$row['dish_name']."</td><td>".$row['cuisine']."</td><td>".$row['ingredients']."</td><td>".$row['veg_or_nonveg']."</td>
            </tr>";
	    }
	} else {
	    echo "No results";
	}
	
	$html=$html."</table></html>";
	echo $html;
    echo "error";
mysqli_close($conn);

?>