<?php

function functionCalltoAdd($conn) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $house_no = $_POST['houseno'];
    $state = $city = '';
    $city = $_POST['city'];
    $pin = $_POST['pincode'];

    $result = mysqli_query($conn, "SELECT `name` FROM `state` WHERE `allState_Id`='$_POST[state]'");
    foreach (mysqli_fetch_all($result) as $map) {
        $state = $map[0];
    }

    $result1 = mysqli_query($conn, "SELECT `city_name` FROM `city` WHERE `city_Id`='$_POST[city]'");
    foreach (mysqli_fetch_all($result1) as $map) {
        $city = $map[0];
    }

    $query = "INSERT INTO `store_address` (`name`,`email`,`house_no`,`state`,`city`,`pincode`) VALUES ('$name','$email','$house_no','$state','$city','$pin')";
    $conn->query($query);
}

function functionCalltoShow($conn) {
    $query = "SELECT * FROM `store_address`";
    $result = $conn->query($query);
    mysqli_fetch_all($result);
    echo "<table class='table'><thead><tr><th scope='col'>ID</th><th scope='col'>Name</th><th scope='col'>Email</th><th scope='col'>House No</th><th scope='col'>State</th><th scope='col'>City</th><th scope='col'>Pincode</th><th scope='col'>Last Modified</th></tr></thead><tbody>";
    foreach ($result as $map) {
        echo "<tr><th scope='row'>" . $map['Id'] . "</th><td>" . $map['name'] . "</td><td>" . $map['email'] . "</td><td>" . $map['house_no'] . "</td><td>" . $map['state'] . "</td><td>" . $map['city'] . "</td><td>" . $map['pincode'] . "</td><td>" . $map['modified'] . "</td></tr>";
    }

    echo "</tbody></table>";
}
