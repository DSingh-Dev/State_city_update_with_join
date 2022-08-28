<?php

include('../function.php');
$conn = dbConnection();
$query = "SELECT `city`.`city_Id`,  `city`.city_name,`state`.name,`state`.`allState_Id`  FROM `city` INNER JOIN `state`  ON `state`.`allState_Id`=`city`.state_id ";
$query = "SELECT * FROM `state`";
$result = $conn->query($query);
$result2 = $conn->query($query);


if($_SERVER['REQUEST_METHOD'] == 'POST'){
            
    if(isset($_POST['update'])){

        echo $_POST['update_cityid'];
    }
    

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update <?php echo $_POST['id'] ?></title>
        <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>

</head>
<body class="container mt-3 ">
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
            <div class="mb-3">
                <label for="city_id" class="form-label">City ID</label>
                <input type="text" class="form-control" id="city_id" name="update_cityid" value="<?php echo $_POST['id']; ?>" readonly >
            </div>
            <div class="col-auto">
                <label for="city" class="form-label">City</label>
                <select class="form-control" name="update_city">
                        <option value="">--Select--</option>
                        <option value="<?php if(!empty($_POST['city'])){
                            echo $_POST['city'];
                          ?>" <?php echo 'selected'; }?>><?php echo $_POST['city']; ?></option>
                          <?php
                          $data = mysqli_fetch_all($result);
                          foreach($data as $map){
                                    echo "<option>". $map[1]."</option>"; 
                          }?>
                </select>
            </div>
            <div class="col-auto">
                <label for="state" class="form-label">State</label>
                <select class="form-control" name="update_state">
                        <option value="">--Select--</option>
                        <option value="<?php if(!empty($_POST['state'])){
                            echo $_POST['state'];
                          ?>" <?php echo 'selected'; }?>><?php echo $_POST['state']; ?></option>
                           <?php
                           $data2 = mysqli_fetch_all($result2);
                          foreach($data2 as $map){
                                    echo "<option>". $map[1]."</option>"; 
                          }?>
                </select>
            </div>
            <div class="mb-3">
                <label for="state_id" class="form-label">State ID</label>
                <input type="text" class="form-control" id="state_id" name="update_stateid" value="<?php echo $_POST['stateid']; ?>" readonly>
            </div>
            <button type="submit"  class='btn btn-success' name="update" >Update</button>
</form>
</body>
</html>