<?php
include('./function.php');
$conn = dbConnection();
include('./store.php');

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if (isset($_POST['search'])) {
        functionCalltoShow($conn);
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>

<body class="container-fluid container">
    <form method="post" class="mt-2" action="<?php echo $_SERVER['PHP_SELF']; ?>">

        <div class="row g-3 mt-2 align-items-center">
            <div class="col-auto">
                <input type="submit" value="Show Address Table" class="btn btn-dark" name="search" />
            </div>
        </div>
    </form>

</body>

</html>