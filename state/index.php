<?php
include('../function.php');
$conn = dbConnection();
//Insert Data in Database
function call_to_Add($conn) {
    $state_name = $_POST['state_name'];
    $state_status = $_POST['active'];
    if (!empty($state_name) && !empty($state_status)) {
        $query = "INSERT INTO `state`(`name`,`status`) VALUES ('$state_name','$state_status') ";
        $conn->query($query);
    } else
    if (!empty($state_name) && empty($state_status)) {
        $state_status = 'In-active';
        $query = "INSERT INTO `state`(`name`,`status`) VALUES ('$state_name','$state_status') ";
        $conn->query($query);
    }
}



if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['add'])) {
        call_to_Add($conn);
        header('Location: index.php');
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
            <input type="text" value="" placeholder="add new value" name="state_name" />
            <div>
                <label>Status </label>
                <input class="form-check-input" type="checkbox" name="active" value="active" id="flexCheckDefault">
            </div>
            <input type="submit" name="add" class="btn btn-light" value="Add" />
        </form>
        <div style="display:flex">
            <div style="width: 50%">
                <a href="./update.php">
                    <--Update State-->
                </a>
            </div>
            <div style="width: 50%">
                <a href="./show.php">
                    <--Show State Table-->
                </a>
            </div>
        </div>
    </div>

</body>

</html>