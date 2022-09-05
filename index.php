<?php
include('./php_functions/functions.php');
$conn = dbConnection();
include('./php_functions/function_address.php');

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Records</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>

<body class="container-fluid container" style="background: #f0f0f0;">
    <h2 style="text-align:center;">All Record's of Address</h2>
    <hr>
    <form method='post'>
        <?php functionCalltoShow($conn); ?>
    </form>
    <div style="display: flex;">
        <div>

            <a href="../address/address.php">
                <button type="button" class="btn btn-secondary">Add New Address
                </button>
            </a>
        </div>
        <div style="position: relative;width: 50%;left: 50%;">
            <a href="../address/city/index.php">
                <button type="button" class="btn btn-secondary">
                    View City's
                </button></a>
        </div>
    </div>
</body>

</html>