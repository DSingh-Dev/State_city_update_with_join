<?php
include('../php_functions/functions.php');
$conn = dbConnection();

$id = $_GET['id'];

function call_to_Update($conn, $id) {

    if (isset($_POST['update'])) {
        $state_name = $_POST['state_name'];
        $status = isset($_POST['status']) ? $_POST['status'] : "In-active";
        // if ($status != 'active') {
        //     $status = 'In-active';
        // }
        $update_query = "UPDATE `state` SET `name`='$state_name',`status`='$status' WHERE `allState_Id` = $id";
        $conn->query($update_query);
    }
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['update'])) {
        call_to_Update($conn, $id);
    }
}
$query = "SELECT * FROM `state` WHERE `allState_Id`=$id ";
$result = $conn->query($query);
$data = mysqli_fetch_all($result);
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
        <h2>Update State</h2>
        <form method="post" class="mt-2" action="<?php $_SERVER['PHP_SELF']; ?>">
            <input type="text" value="<?php echo $data[0][1]; ?>" name="state_name" />
            <div>
                <label>Status </label>
                <input class="form-check-input" type="checkbox" name="status" value="active" <?php if ($data[0][2] === "active") {
                                                                                                    echo "checked";
                                                                                                } else {
                                                                                                    echo "";
                                                                                                } ?>>
            </div>
            <input type="submit" name="update" class="btn btn-success" value="Update" />
    </div>
    <div style="display:flex">
        <div style="width: 50%">
            <a href="./add.php">
                <--Add State-->
            </a>
        </div>
        <div style="width: 50%">
            <a href="./index.php">
                <--Show State Table-->
            </a>
        </div>
    </div>
</body>

</html>