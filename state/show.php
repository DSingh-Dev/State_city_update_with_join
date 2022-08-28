<?php
include('../function.php');


//Show Data from database
function call_to_show($conn) {

    $state_name = $_POST['state_show'];
    $query = "SELECT * FROM `state`";
    $query_var = "SELECT * FROM `state` WHERE `name`='$state_name'";
    $data_var = $conn->query($query_var);

    mysqli_fetch_all($data_var);
    $data = $conn->query($query);
    mysqli_fetch_all($data);

    //$result = mysqli_num_rows($data_var);

    echo "<table class='table'><thead><tr><th scope='col'>ID</th><th scope='col'>State's</th><th scope='col'>Status</th></tr></thead><tbody>";
    if (!empty($state_name)) {
        foreach ($data_var as $map) {
            echo "<tr><th scope='row'>" . $map['allState_Id'] . "</th><td>" . $map['name'] . "</th><td>" . $map['status'] . "</td>";
        }
    } else if (empty($state_name)) {
        foreach ($data as $map) {
            echo "<tr><th scope='row'>" . $map['allState_Id'] . "</th><td>" . $map['name'] . "</th><td>" . $map['status'] . "</td>";
        }
    }

    echo "</tbody></table>";
}


if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $conn = dbConnection();
    if (isset($_POST['show'])) {
        call_to_Show($conn);
    }
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
    <div class="container-fluid container">
        <form method="post" class="mt-2" action="<?php $_SERVER['PHP_SELF']; ?>">
            <input type="text" value="" placeholder="Search any name" name="state_show" />
            <input type="submit" class="btn btn-primary" name="show" value="Show" />
        </form>
    </div>
    <div style="display:flex">
        <div style="width: 50%">
            <a href="./state.php">
                <--Add State-->
            </a>
        </div>
        <div style="width: 50%">
            <a href="./update.php">
                <--Update State-->
            </a>
        </div>
    </div>
</body>

</html>