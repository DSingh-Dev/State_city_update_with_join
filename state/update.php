<?php
include('../functions.php');



//Update Data in Database
function call_to_Update($conn) {
    $state_name = $_POST['state_where'];
    $updated_name = $_POST['state_updated'];
    $state_status = $_POST['active'];
    if (!empty($state_name) && !empty($updated_name) && !empty($state_status)) {
        $query = "UPDATE `state` SET `name`='$updated_name',`status`='$state_status' WHERE `name`='$state_name'";
        $conn->query($query);
    }
    if (!empty($state_name) && !empty($updated_name) && empty($state_status)) {
        $state_status = 'In-active';
        $query = "UPDATE `state` SET `name`='$updated_name',`status`='$state_status' WHERE `name`='$state_name'";
        $conn->query($query);
    }
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $conn = dbConnection();
    if (isset($_POST['update'])) {
        call_to_Update($conn);
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
            <input type="text" value="" placeholder="where updated" name="state_where" />
            <input type="text" value="" placeholder="what updated" name="state_updated" />
            <div>
                <label>Status </label>
                <input class="form-check-input" type="checkbox" name="active" value="active" id="flexCheckDefault">
            </div>
            <input type="submit" class="btn btn-success" name="update" value="Update" />
            </br>
        </form>
    </div>
    <div style="display:flex">
        <div style="width: 50%">
            <a href="./state.php">
                <--Add City-->
            </a>
        </div>
        <div style="width: 50%">
            <a href="./show.php">
                <--Show State Table-->
            </a>
        </div>
    </div>
</body>

</html>