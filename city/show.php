<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
include('../function.php');
$conn = dbConnection();
$query = "SELECT `city`.`city_Id`,  `city`.city_name,`state`.name,`state`.`allState_Id`  FROM `city` INNER JOIN `state`  ON `state`.`allState_Id`=`city`.state_id ";
$query2 = "SELECT `city`.`city_Id`,  `city`.city_name,`state`.name,`state`.`allState_Id`  FROM `city` INNER JOIN `state`  ON `state`.`allState_Id`=`city`.state_id ";
$result = $conn->query($query);
$result1 = $conn->query($query2);
foreach(mysqli_fetch_all($result1) as $m){
    if(isset($_POST['updateid_'.$m[0].''])){
        echo "button".$m[0]." is clicked";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show City's</title>
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</head>
<style>
    input{
        border: none;
        background: transparent;
        outline: none;
    }
    </style>
<body>
    <table class="table table-striped">
        <thead>
            <tr><th>City Id</th><th>City Names</th><th>State Names</th><th>State Id</th></tr>
        </thead>
       
        <?php
           
            foreach(mysqli_fetch_all($result) as $map){
                echo "<form method='post' action='update.php'>";
                echo "<tr><th><input type='text' name='id' value='".$map[0]."' readonly /></th>";
                echo "<td><input type='text' name='city' value='".$map[1]."' readonly /></td>";
                echo "<td><input type='text'  name='state' value='".$map[2]."'  readonly/></td>";
                echo "<td> <input type='text' name='stateid' value='".$map[3]."'  readonly/></td>";
                echo "<td><input type='submit' class='btn btn-success' name='updateid_".$map[0]. "'  value='update' ></form></td></tr>";
                
            }
        ?>
    </table>
</body>
</html>