<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'dbconnection.php';

$html = "<html><table style='width:100%' border='1px solid black'><tr>
    <th>dishname</th>
    <th>cuisine</th>
    <th>ingredients</th>
    <th>veg_or_nonveg</th>
    <th>image</th>
  </tr>";

$sql = "SELECT dish_name, cuisine, ingredients, veg_or_nonveg, dish_id FROM vibushan_menu";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        $image = $row['dish_id'] . ".jpg"; // Assuming the image file name is constructed using dish id
        $html .= "<tr><td>".$row['dish_name']."</td><td>".$row['cuisine']."</td><td>".$row['ingredients']."</td><td>".$row['veg_or_nonveg']."</td><td><img src='$image' alt='".$row['dish_name']."' width='200' height='200'></td></tr>";
    }
} else {
    $html .= "<tr><td colspan='5'>No results</td></tr>";
}

$html .= "</table></html>";
echo $html;
mysqli_close($conn);
?>
