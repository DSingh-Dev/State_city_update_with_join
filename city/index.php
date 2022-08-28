<?php
error_reporting(E_ALL);
ini_set('display_errors', true);

include_once("../function.php");
$conn = dbConnection();

function call_to_add($conn) {
    $city = $_POST['city'];
    $state = $_POST['state'];
    $status = $_POST['status'];

    if (!empty($city) && !empty($state) && !empty($status)) {
        $city_query = "INSERT INTO `city` (`city_name`,`state_id`,`status`) VALUES ('$city','$state','$status')";
        $conn->query($city_query);
    } else if (!empty($city) && empty($state) && !empty($status)) {
        $status = 'In-active';
        $city_query = "INSERT INTO `city` (`city_name`,`state_id`,`status`) VALUES ('$city','$state','$status')";
        $conn->query($city_query);
    }
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if (isset($_POST['add_city'])) {

        call_to_add($conn);
        header('Location: city.php');
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

<body class="container">
    <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
        <div class=" mb-3">
            <label for="add_city" class="form-label">ADD New City</label>
            <input type="text" class="form-control" name="city" id="add_city">
        </div>
        <div class="mb-3">
            <label for="status">States</label>
            <select name="state" class="form-select">
                <option value="">--Select--</option>
                <?php
                $state_query = "SELECT DISTINCT `allState_Id`,`name` FROM `state` WHERE `status`='active'";
                $result = mysqli_query($conn, $state_query);
                while ($r = mysqli_fetch_row($result)) {
                    echo "<option value='$r[0]'> $r[1] </option>";
                }
                ?>
            </select>
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" value="active" name="status" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Status</label>
        </div>
        <button type="submit" name="add_city" class="btn btn-primary">Add City</button>
    </form>
    <div style="display:flex;text-align: center;">
        <div style="width: 50%">
            <a href="./show.php">
                <--Show city-->
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