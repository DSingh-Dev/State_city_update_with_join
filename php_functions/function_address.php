<?php

function functionCalltoAdd($conn) {

    $name = $conn->real_escape_string($_POST['name']);
    $email = $_POST['email'];
    $house_no = $_POST['houseno'];
    $state = $_POST['state'];
    $city = $_POST['city'];
    $pin = $_POST['pincode'];

    $query = "INSERT INTO `store_address` (`full_name`,`email`,`house_no`,`state`,`city`,`pincode`) VALUES ('$name','$email','$house_no','$state','$city','$pin')";
    $conn->query($query);
}

function functionCalltoShow($conn) {
    $query = "SELECT 
    `store_address`.`Id`,`store_address`.`full_name`,
    `store_address`.`email`,`store_address`.`house_no`,
    `state`.`name`,`city`.`city_name`,`store_address`.`pincode`,`store_address`.`modified`
     FROM
      `store_address` 
     LEFT JOIN `state` on `store_address`.`state`=`state`.`allState_Id` 
     LEFT JOIN `city` on `store_address`.`city`=`city`.`city_Id` ORDER BY `store_address`.`modified` DESC ";
    $result = $conn->query($query);
    mysqli_fetch_all($result);
    if (isset($_POST['delete_m'])) {
        if (isset($_POST['delete']))
            //  deleteMultiple_Records($_POST['delete'], $conn);
            foreach ($_POST['delete'] as $delete_id) {

                $conn->query("DELETE FROM `store_address` WHERE `Id`=$delete_id");
                header('Location: index.php');
            }
    }
    echo "<table class='table'>
            <input type='submit' name='delete_m' class='btn btn-danger' value='Delete Multiple Records'>
            <thead>
            <tr><th></th><th scope='col'>ID</th>
                <th scope='col'>Name</th>
                <th scope='col'>Email</th>
                <th scope='col'>House No</th>
                <th scope='col'>State</th>
                <th scope='col'>City</th>
                <th scope='col'>Pincode</th>
                <th scope='col'>Last Modified</th>
            </tr></thead><tbody>";

    foreach ($result as $map) {
        echo "<tr><td><input type='checkbox' name='delete[]' value='" . $map['Id'] . "'/></td>
                <th scope='row'>" . $map['Id'] . "</th>
                <td>" . $map['full_name'] . "</td>
                <td>" . $map['email'] . "</td>
                <td>" . $map['house_no'] . "</td>
                <td>" . $map['name'] . "</td>
                <td>" . $map['city_name'] . "</td>
                <td>" . $map['pincode'] . "</td>
                <td>" . $map['modified'] . "</td>
                <td>
                    <a href='./update_address.php?id=" . $map['Id'] . "'>
                        <button type='button' class='btn btn-success'>Update</button>
                    </a>
                </td>
                <td>
                    <a href='./delete.php?id=" . $map['Id'] . "'>
                        <button type='button' class='btn btn-danger' >Delete</button>
                    </a>
                </td>
              </tr>";
    }

    echo "</tbody></table>";

    
}
function functionCalltoUpdate($conn, $id) {
    if (isset($_POST['update'])) {
        $name = $conn->real_escape_string($_POST['name']);
        $email = $_POST['email'];
        $hno = $_POST['houseno'];
        $state = $_POST['state'];
        $city = $_POST['city'];
        $pin = $_POST['pincode'];

        $query = "UPDATE `store_address` SET `full_name`='$name', `email`= '$email', `house_no`='$hno', `state`='$state', `city`='$city',`pincode`='$pin' WHERE `id` = '$id' ";
        $conn->query($query);
    }
}

// function deleteMultiple_Records($delete_multiple, $conn) {

    
// }
