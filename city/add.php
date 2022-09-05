<?php
error_reporting(E_ALL);
ini_set('display_errors', true);
session_start();
include_once("../php_functions/functions.php");
$conn = dbConnection();

function call_to_add($conn) {
    $city = $_POST['city'];
    $state = $_POST['state'];
    $status = isset($_POST['status']) ? $_POST['status'] : "In-active";

    // if ($status != 'active')
    //     $status = 'In-active';

    $city_query = "INSERT INTO `city` (`city_name`,`state_id`,`status`) VALUES ('$city','$state','$status')";
    $conn->query($city_query);
}
//default variable declaration
$stateErr = $cityErr = '';
$chk = true;
$state_val = $city_chk = '';

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $state_val = $_POST['state'];
    $city_chk = $_POST['city'];
    if (isset($_POST['add_city'])) {
        if (empty($city_chk)) {
            $_SESSION['city_check'] = 'Required to fill';
            $cityErr = $_SESSION['city_check'];
            $chk = false;
        }
        if (empty($state_val)) {
            $_SESSION['state_chk'] = 'Select at least one';
            $stateErr = $_SESSION['state_chk'];
            $chk = false;
        }
        if ($chk === true) {
            call_to_add($conn);
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
    <title>City</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>
<style>
    .error {
        color: #f00;
        margin-left: 34px;
    }
</style>

<body class="container">
    <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
        <div class=" mb-3">
            <label for="add_city" class="form-label">ADD New City</label>
            <input type="text" class="form-control" name="city" value="<?php echo $city_chk; ?>" id="add_city">
            <?php echo "<span class='error'>" . $cityErr . "</span>"; ?>
        </div>
        <div class="mb-3">
            <label for="status">States</label>
            <select name="state" class="form-select">
                <option value="">--Select--</option>
                <?php
                //Loop for All State
                $state_query = "SELECT DISTINCT `allState_Id`,`name` FROM `state` WHERE `status`='active'";
                $result = mysqli_query($conn, $state_query);
                while ($r = mysqli_fetch_row($result)) {
                    if ($state_val === $r[0]) {
                        echo "<option value='$r[0]' selected> $r[1] </option>";
                    } else {
                        echo "<option value='$r[0]'> $r[1] </option>";
                    }
                }
                ?>
            </select>
            <?php echo "<span class='error'>" . $stateErr . "</span>"; ?>
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" value="active" name="status" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Status</label>
        </div>
        <button type="submit" name="add_city" class="btn btn-primary">Add City</button>
    </form>
    <hr />
    <div style="display:flex;text-align: center;">
        <div style="width: 50%">
            <a href="./index.php">
                <button type="button" class="btn btn-warning">
                    Show city
                </button>
            </a>
        </div>
        <div style="width: 50%">
            <a href="../index.php">
                <button type="button" class="btn btn-warning">
                    Show Address
                </button>
            </a>
        </div>

    </div>
    <hr />
</body>

</html>
<?php
unset($_SESSION['city_check']);
unset($_SESSION['state_val']);

?>