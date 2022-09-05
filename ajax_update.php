<?php

include('./php_functions/functions.php');
$conn = dbConnection();

$state_id = $_POST["state_id"];
$city_id = $_POST['city_id'];

$query = mysqli_query($conn, "SELECT * FROM `city` WHERE `state_id` = '$state_id'");

?>
<option value="">Select City</option>
<?php

while ($row = mysqli_fetch_array($query)) {
?>
    <?php if ($city_id == $row['city_Id']) {
    ?>
        <option value="<?php echo $row['city_Id']  ?>" selected><?php echo $row['city_name'] ?></option>
    <?php
    } else { ?>

        <option value="<?php echo $row['city_Id'] ?>"><?php echo $row['city_name'] ?></option>

<?php
    }
}
?>