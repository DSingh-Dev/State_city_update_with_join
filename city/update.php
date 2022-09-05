<?php
error_reporting(E_ALL);
ini_set('display_errors', true);
//DB Connection
include('../php_functions/functions.php');
$conn = dbConnection();
$id = $_GET['id'];

$chk_city = $city_err =  '';
$default = true;
$city_list = "SELECT * FROM `city`";
$city_result = $conn->query($city_list);

//After Submit Work
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $chk_city = $_POST['update_city'];

    if (isset($_POST['update'])) {

        if ($chk_city === "") {
            $city_err = "Required field";
            $default = false;
        }

        if ($default === true) {
            $query_city_fetch = "SELECT `city_name` FROM `city` WHERE `city_Id`=$chk_city";
            $city_fetch = $conn->query($query_city_fetch);
            $city_fetch_result = mysqli_fetch_assoc($city_fetch);
            $status = isset($_POST['status_city']) ? $_POST['status_city'] : "In-active";


            $update_query = "UPDATE `city` SET `city_name`='$city_fetch_result[city_name]',`status`='$status' WHERE `city_Id` = $id";
            $conn->query($update_query);
        }
    }
}

//Query's
$query = "SELECT * FROM `city` WHERE `city_Id`=$id ";
$result = $conn->query($query);

//Fetch Query Data
$data = mysqli_fetch_assoc($result);
$state_id =  $data['state_id'];

//print_r($data);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update <?php echo $id; ?></title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <style>
        .error {
            color: #f00;
            margin-left: 34px;
        }
    </style>
</head>

<body class="container mt-3 ">
    <h2>Update City</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) . "?id=$id" ?>">

        <div class="col-auto">
            <label for="city" class="form-label">City</label>
            <select class="form-control" name="update_city">
                <option value="">--Select--</option>
                <?php

                while ($row = mysqli_fetch_array($city_result)) {
                    if ($chk_city === $row['city_Id']) {
                        echo "<option value=" . $row['city_Id'] . " selected>" . $row['city_name'] . "</option>";
                    } else
                    if ($row['city_Id'] === $id) {
                        echo "<option value=" . $row['city_Id'] . " selected>" . $row['city_name'] . "</option>";
                    } else
                        echo "<option value=" . $row['city_Id'] . ">" . $row['city_name'] . "</option>";
                }


                ?>


            </select>

            <span class="error"><?php echo $city_err; ?></span>
        </div>
        <div class="col-auto">
            <label for="state" class="form-label">State</label>
            <select class="form-control" name="update_state" disabled="true">
                <option value="">--Select--</option>
                <?php
                $query_state = "SELECT `state`.`name` FROM `state` WHERE `allState_Id` = $state_id";
                $result = $conn->query($query_state);
                //For Default Selected option but Disabled
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<option value='" . $row[0] . "' selected>" . $row['name'] . "<option>";
                }
                ?>
            </select>
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" value="active" name="status_city" id="exampleCheck1" <?php if ($data['status'] === 'active') {
                                                                                                                        echo 'checked';
                                                                                                                    } else {
                                                                                                                        echo '';
                                                                                                                    }; ?>>
            <label class="form-check-label" for="exampleCheck1">Status</label>
        </div>

        <!-- Form Button -->
        <button type="submit" name="update" class="btn btn-success">Update</button>

    </form>
    <div class="mt-3" style="display: flex">
        <div style="width: 50%">
            <a href="./index.php">
                <button type="button" class="btn btn-warning">
                    Show City Table
                </button>
            </a>
        </div>
        <div style="width: 50%">
            <a href="./add.php">
                <button type="button" class="btn btn-warning">
                    Add New City
                </button>
            </a>
        </div>
    </div>
</body>

</html>