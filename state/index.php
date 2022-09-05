<?php
// error_reporting(E_ALL);
// ini_set('display_errors', true);
include('../php_functions/functions.php');
$conn = dbConnection();

//Show Data from database
function call_to_show($conn) {

    $query = "SELECT * FROM `state`";
    $data = $conn->query($query);
    mysqli_fetch_all($data);


    //loop table structure
    echo "<table class='table'><thead><tr><th scope='col'>ID</th><th scope='col'>State's</th><th scope='col'>Status</th></tr></thead><tbody>";
    foreach ($data as $map) {
        echo "<tr><th scope='row'>" . $map['allState_Id'] . "</th>";
        echo "<td>" . $map['name'] . "</td>";
        echo "<td>" . $map['status'] . "</td>";
        echo "<td><a href='./update.php?id=" . $map['allState_Id'] . "'><button type='button' class='btn btn-success'>Update</button></a></td>";
    }
    echo "</tbody></table>";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>States</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>

<body style="text-align:center;">
    <div style="display:flex; margin-left: 25px;" class="mt-3">
        <div style="margin-right: 25px;">
            <a href="./add.php">
                <button type="button" class="btn btn-info">
                    Add State
                </button>
            </a>
        </div>
        <div>
            <a href="../city/index.php">
                <button type="button" class="btn btn-info">
                    Show All City's
                </button>
            </a>
        </div>
    </div>
    <div class="container-fluid container">

        <!-- Function call to Show Table Data -->
        <?php call_to_Show($conn); ?>
    </div>

</body>

</html>