<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
include('../php_functions/functions.php');
$conn = dbConnection();
$query = "SELECT `city`.`city_Id`,`city`.city_name,`state`.name,`state`.`allState_Id`  FROM `city` INNER JOIN `state`  ON `state`.`allState_Id`=`city`.state_id ";
$result = $conn->query($query);


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
    input {
        border: none;
        background: transparent;
        outline: none;
    }
</style>

<body>
    <div style="display:flex; margin-top: 20px; margin-left:20px;">
        <div>
            <a href="./add.php">
                <button type="button" class="btn btn-warning">
                    Add New City
                </button>
            </a>
        </div>
        <div style="position: relative;width: 50%;left: 50%;">
            <a href="../state/index.php">
                <button type="button" class="btn btn-warning">
                    View State's
                </button>
            </a>
        </div>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>City Id</th>
                <th>City Names</th>
                <th>State Names</th>
                <th>State Id</th>
            </tr>
        </thead>

        <?php

        foreach (mysqli_fetch_all($result) as $map) {
            echo "<tr>";
            echo "<td>$map[0]</td><td>$map[1]</td><td>$map[2]</td><td>$map[3]</td>";
            echo "<td><a href='update.php?id=$map[0]'><button type='button' class='btn btn-success'>Update</button></a></td>";
            echo "</tr>";
        }
        ?>
    </table>

</body>

</html>