<?php
error_reporting(E_ALL);
ini_set('display_errors', true);
session_start();
include('./php_functions/functions.php');
$conn = dbConnection();
include('./php_functions/function_address.php');

$checkSubmit = true;
$name = $email = $hno = $state = $city = $pincode = $form_error = '';
$nameErr = $emailErr = $hnoErr = $stateErr = $cityErr = $pincodeErr = '';
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $hno = $_POST['houseno'];
    $state = $_POST['state'];
    $city = $_POST['city'];
    $pincode = $_POST['pincode'];
    if (empty($name) || !preg_match("/^[a-zA-Z' ]+$/", $name)) {
        $_SESSION['name'] = "simple name is required";
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
    if (empty($pincode) || strlen($pincode) < 6) {
        $_SESSION['pincode'] = "Pin is Required";
        $pincodeErr = $_SESSION['pincode'];
        $checkSubmit = false;
    }
    if ($checkSubmit == true) {
        functionCalltoAdd($conn);
        header('Location: index.php');
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
</head>
<style>
    .error {
        color: #f00;
        margin-left: 34px;
    }
</style>
<script>
    $(document).ready(function(e) {
        $('#state-dropdown').on('change', function() {
            let state_id = this.value;
            $.ajax({
                url: 'ajax_call.php',
                type: "POST",
                data: {
                    state_id: state_id
                },
                cache: false,
                success: function(result) {
                    $('#city-dropdown').html(result);
                }
            })
        });

    })
</script>

<body>
    <div class="container-fluid container">
        <h2>Registration Form</h2>
        <span class="error"><?php echo $form_error; ?></span>
        <form method="post" class="mt-2" action="<?php $_SERVER['PHP_SELF']; ?>">
            <div class="row g-3 mt-2 align-items-center">
                <div class="col-auto">
                    <label for="name" class="col-form-label">Name:</label>
                </div>
                <div class="col-auto d-flex">
                    <input type="text" class="form-control" value="<?php echo $name; ?>" id="name" name="name" />
                    <?php echo "<span class='error'>" . $nameErr . " </span>"; ?>
                </div>

            </div>
            <div class="row g-3 mt-2 align-items-center">
                <div class="col-auto">
                    <label for="email" class="col-form-label">Email:</label>
                </div>
                <div class="col-auto">
                    <input type="text" class="form-control" value="<?php echo $email; ?>" id="email" name="email" />
                    <?php echo "<span class='error'>" . $emailErr . " </span>"; ?>
                </div>
            </div>
            <div class="row g-3 mt-2 align-items-center">
                <div class="col-auto">
                    <label for="hno">House No.:</label>
                </div>
                <div class="col-auto">
                    <input type="text" value="<?php echo $hno; ?>" class="form-control" id="hno" name="houseno" />
                    <?php echo "<span class='error'>" . $hnoErr . " </span>"; ?>
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
                        $state_query = "SELECT DISTINCT `allState_Id`,`name` FROM `state` WHERE `status`='active'";
                        $result = mysqli_query($conn, $state_query);
                        while ($r = mysqli_fetch_row($result)) {
                            if ($state === $r[0]) {
                                echo "<option value='$r[0]' selected> $r[1] </option>";
                            } else {
                                echo "<option value='$r[0]'> $r[1] </option>";
                            }
                        }
                        ?>

                    </select>
                    <?php echo "<span class='error'>" . $stateErr . " </span>"; ?>
                </div>
            </div>
            <div class="row g-3 mt-2 align-items-center">
                <div class="col-auto">
                    <label for="city">City:</label>
                </div>
                <div class="col-auto">
                    <select class="form-control" name="city" id="city-dropdown">
                        <option value=" ">--Select--</option>
                    </select>
                    <?php echo "<span class='error'>" . $cityErr . " </span>"; ?>
                </div>
            </div>
            <div class="row g-3 mt-2 align-items-center">
                <div class="col-auto">
                    <label for="pincode">Pincode: </label>
                </div>
                <div class="col-auto">
                    <input type="text" class="form-control" value="<?php echo $pincode; ?>" name="pincode" id="pincode" />
                </div>
                <?php echo "<span class='error'>" . $pincodeErr . " </span>"; ?>
            </div>
            <div class="row g-3 mt-2 align-items-center">
                <div class="col-auto">
                    <input type="submit" class="btn btn-dark" value="Submit" name="submit" />
                </div>
            </div>
            <div class="mb-3 d-flex" style="justify-content: center;">
                <div class="mt-3" style="margin-right: 25px;">

                    <a href="../address/index.php"><button type="button" class="btn btn-secondary">
                            Show All Address
                        </button></a>
                </div>
                <div class="mt-3">
                    <a href="../address/state/index.php"><button type="button" class="btn btn-secondary">
                            Show All states
                        </button></a>
                </div>
            </div>
        </form>
    </div>

</body>

</html>
<?php unset($_SESSION['name']);
unset($_SESSION['email']);
unset($_SESSION['houseno']);
unset($_SESSION['state']);
unset($_SESSION['city']);
unset($_SESSION['pincode']);
unset($_SESSION['error']);
?>