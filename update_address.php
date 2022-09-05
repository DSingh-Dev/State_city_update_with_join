<?php
error_reporting(E_ALL);
ini_set('display_errors', true);
session_start();
//DB Connection file inclusion
include('./php_functions/functions.php');
$conn = dbConnection();
$id = $_GET['id'];
include('./php_functions/function_address.php');

$checkSubmit = true;
$state_auto = '';
$name = $email = $hno = $state = $city = $pincode = $form_error = '';
$nameErr = $emailErr = $hnoErr = $stateErr = $cityErr = $pincodeErr = '';

//Query Statements
$query = "SELECT * FROM `store_address` WHERE `Id`=$id";
$result = $conn->query($query);
$data = mysqli_fetch_assoc($result);

$state = $data["state"];
$city = $data["city"];

// echo '<pre>';
// print_r($data);
// echo '<br>';
// echo $state;
// echo '<br>';
// echo $city;
// echo '<br>';

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $hno = $_POST['houseno'];
    $state = $_POST['state'];
    $pincode = $_POST['pincode'];
    $city = $_POST['city'];

    if (empty($name) ||  !preg_match("/^[a-zA-Z']+$/", $name)) {
        $_SESSION['name'] = "simple name required";
        $nameErr = $_SESSION['name'];
        $checkSubmit = false;
    }
    if (empty($email) || !preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $email)) {
        $_SESSION['email'] = "Email Pettern is Wrong";
        $emailErr = $_SESSION['email'];
        $checkSubmit = false;
    }
    if (empty($hno) || strlen($hno) < 1) {
        $_SESSION['houseno'] = "House no can't be empty";
        $hnoErr = $_SESSION['houseno'];
        $checkSubmit = false;
    }
    if ($state === " ") {
        $_SESSION['state'] = "Select at least one";
        $stateErr = $_SESSION['state'];
        $checkSubmit = false;
    }
    if ($city === " ") {
        $_SESSION['city'] = "Select at Least One";
        $cityErr = $_SESSION['city'];
        $checkSubmit = false;
    }
    if (empty($pincode) || strlen($pincode) < 6 || !preg_match('/^[0-9]{6}/', $pincode)) {
        $_SESSION['pincode'] = "Pin is Required";
        $pincodeErr = $_SESSION['pincode'];
        $checkSubmit = false;
    }
    if ($checkSubmit == true) {
        functionCalltoUpdate($conn, $id);
    } else {
        $_SESSION['error'] = '* All fields Required!';
        $form_error = $_SESSION['error'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Address</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

    <style>
        .error {
            color: #f00;
            margin-left: 34px;
        }
    </style>
</head>


<body>
    <div class="container-fluid container">
        <h2>Update Form</h2>
        <span class="error"><?php echo $form_error; ?></span>
        <form method="post" class="mt-2" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) . "?id=$id" ?>">
            <div class="row g-3 mt-2 align-items-center">
                <div class="col-auto">
                    <label for="name" class="col-form-label">Name:</label>
                </div>
                <div class="col-auto">
                    <input type="text" class="form-control" value="<?php if (!empty($name)) {
                                                                        echo $name;
                                                                    } else
                                                                        echo $data['full_name']; ?>" id="name" name="name" />
                    <?php echo "<span class='error'> " . $nameErr . "</span>"; ?>
                </div>
            </div>
            <div class="row g-3 mt-2 align-items-center">
                <div class="col-auto">
                    <label for="email" class="col-form-label">Email:</label>
                </div>
                <div class="col-auto">
                    <input type="text" class="form-control" value="<?php if (!empty($email)) {
                                                                        echo $email;
                                                                    } else echo $data['email']; ?>" id="email" name="email" />
                    <?php echo "<span class='error'> " . $emailErr . "</span>"; ?>
                </div>
            </div>
            <div class="row g-3 mt-2 align-items-center">
                <div class="col-auto">
                    <label for="hno">House No.:</label>
                </div>
                <div class="col-auto">
                    <input type="text" value="<?php if (!empty($hno)) {
                                                    echo $hno;
                                                } else echo $data['house_no']; ?>" class="form-control" id="hno" name="houseno" />
                    <?php echo "<span class='error'> " . $hnoErr . "</span>"; ?>
                </div>
            </div>
            <div class="row g-3 mt-2 align-items-center">
                <div class="col-auto">
                    <label for="state">state:</label>
                </div>
                <div class="col-auto">
                    <select class="form-control" name="state" id="state-dropdown">
                        <option value=" ">--Select--</option>
                        <?php

                        $state_query = "SELECT `allState_Id`,`name` FROM `state` WHERE `status`='active'";
                        $result = mysqli_query($conn, $state_query);
                        while ($r = mysqli_fetch_assoc($result)) {
                            if ($state === $r['allState_Id'])
                                echo "<option value='" . $r['allState_Id'] . "' selected>" . $r['name'] . "</option>";
                            else {
                                echo "<option value='" . $r['allState_Id'] . "'> " . $r['name'] . " </option>";
                            }
                        }

                        ?>

                    </select>
                    <?php echo "<span class='error'> " . $stateErr . "</span>"; ?>
                </div>
            </div>
            <?php  ?>
            <div class="row g-3 mt-2 align-items-center">
                <div class="col-auto">
                    <label for="city">City:</label>
                </div>
                <div class="col-auto">
                    <select class="form-control" name="city" id="city-dropdown">
                        <?php
                        echo "<option value='" . $data['city'] . "' selected>" . $data['city'] . "</option>";
                        ?>
                    </select>
                    <?php echo "<span class='error'> " . $cityErr . "</span>"; ?>
                </div>
            </div>
            <div class="row g-3 mt-2 align-items-center">
                <div class="col-auto">
                    <label for="pincode">Pincode: </label>
                </div>
                <div class="col-auto">
                    <input type="text" class="form-control" value="<?php if (!empty($pincode)) {
                                                                        echo $pincode;
                                                                    } else {
                                                                        echo $data['pincode'];
                                                                    } ?>" name="pincode" id="pincode" />
                    <?php echo "<span class='error'> " . $pincodeErr . "</span>"; ?>
                </div>
            </div>
            <div class="row g-3 mt-2 align-items-center">
                <div class="col-auto">
                    <input type="submit" class="btn btn-success" value="Update" name="update" />
                </div>
            </div>
            <div class="mt-3">
                <a href="../address/index.php"> --Show All Address--</a>
            </div>
            <div class="mt-3">
                <a href="../address/address.php"> --Add Address--</a>
            </div>
        </form>
    </div>
    <script>
        $(document).ready(function(e) {

            $('#state-dropdown').on('change', function() {
                let state_id = this.value;
                let city_id = '<?php echo $city; ?>';
                $.ajax({
                    url: 'ajax_update.php',
                    type: "POST",
                    data: {
                        state_id: state_id,
                        city_id: city_id
                    },
                    cache: false,
                    success: function(result) {
                        $('#city-dropdown').html(result);
                    }
                })
            });
            $('#state-dropdown').trigger('change');
        })
    </script>

</body>

</html>