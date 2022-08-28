<?php

include('./function.php');
$conn = dbConnection();

$city_id = $_POST["state_id"];

$query = mysqli_query($conn, "SELECT * FROM `city` WHERE `state_id` = '$city_id'");
?>
<option value="">Select State</option>
<?php

while ($row = mysqli_fetch_array($query)) {
?>
    <option value="<?php echo $row['city_Id'] ?>"><?php echo $row['city_name'] ?></option>

<?php
}
?>