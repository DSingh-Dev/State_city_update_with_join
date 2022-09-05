<?php
session_start();
include('../php_functions/functions.php');
$conn = dbConnection();
//Insert Data in Database
function call_to_Add($conn) {
    $state_name = $_POST['state_name'];
    $state_status = isset($_POST['active']) ? $_POST['active'] : "In-active";

    $query = "INSERT INTO `state`(`name`,`status`) VALUES ('$state_name','$state_status') ";
    $conn->query($query);
}

//default variable declaration

$state_chk = $stateErr = '';
$chk = '';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $state_chk = $_POST['state_name'];
    if (isset($_POST['add'])) {
        if (empty($city_chk)) {
            $_SESSION['state_check'] = 'Required to fill';
            $stateErr = $_SESSION['state_check'];
            $chk = false;
        }
        if ($chk === true) {
            call_to_Add($conn);
            header('Location: index.php');
        }
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
<style>
    .error {
        color: #f00;
        margin-left: 34px;
    }
</style>

<body style="text-align:center;">
    <div class="container-fluid container">
        <h2>Add State</h2>
        <form method="post" class="mt-2" action="<?php $_SERVER['PHP_SELF']; ?>">
            <input type="text" value="" placeholder="add new value" value="<?php echo $state_chk; ?>" name="state_name" />
            <?php echo "<span class='error'>" . $stateErr . "</span>"; ?>
            <div>
                <label>Status </label>
                <input class="form-check-input" type="checkbox" name="active" value="active" id="flexCheckDefault">
            </div>
            <input type="submit" name="add" class="btn btn-light" value="Add" />
        </form>
        <div style="display:flex">
            <div style="width: 50%">
                <a href="./index.php">
                    <button type="button" class="btn btn-info">
                        Show All State
                    </button>
                </a>
            </div>
            <div style="width: 50%">
                <a href="../index.php">
                    <button type="button" class="btn btn-info">
                        Show Address
                    </button>
                </a>
            </div>
        </div>
    </div>

</body>

</html>