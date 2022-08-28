<?php 
include('./function.php');
$conn = dbConnection();
include('./store.php');



if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $stateData = getStateArray($conn);
    functionCalltoAdd($conn);
    header('Location: index.php');
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
        <form method="post" class="mt-2" action="<?php $_SERVER['PHP_SELF']; ?>">
            <div class="row g-3 mt-2 align-items-center">
                <div class="col-auto">
                    <label for="name" class="col-form-label">Name:</label>
                </div>
                <div class="col-auto">
                    <input type="text" class="form-control" value="" id="name" name="name" />
                </div>
            </div>
            <div class="row g-3 mt-2 align-items-center">
                <div class="col-auto">
                    <label for="email" class="col-form-label">Email:</label>
                </div>
                <div class="col-auto">
                    <input type="text" class="form-control" value="" id="email" name="email" />
                </div>
            </div>
            <div class="row g-3 mt-2 align-items-center">
                <div class="col-auto">
                    <label for="hno">House No.:</label>
                </div>
                <div class="col-auto">
                    <input type="text" value="" class="form-control" id="hno" name="houseno" />

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
                            echo "<option value='$r[0]'> $r[1] </option>";
                        }
                        ?>

                    </select>
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
                </div>
            </div>
            <div class="row g-3 mt-2 align-items-center">
                <div class="col-auto">
                    <label for="pincode">Pincode: </label>
                </div>
                <div class="col-auto">
                    <input type="text" class="form-control" value="  " name="pincode" id="pincode" />
                </div>
            </div>
            <div class="row g-3 mt-2 align-items-center">
                <div class="col-auto">
                    <input type="submit" class="btn btn-dark" value="Submit" name="submit" />
                </div>
            </div>
        </form>
    </div>

</body>

</html>