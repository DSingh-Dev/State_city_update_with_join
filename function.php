<?php
//Database Connection
function dbConnection() {
    $db = new mysqli('localhost','root','','store');
    if($db->connect_error){
        die("connection failed ".$db->connect_error);
    }
    return $db;
}


//City and State Join
function getStateArray($conn) {
    $sql = "SELECT `city`.`city_Id`, `state`.name, `city`.city_name,`state`.`allState_Id`  FROM `city` INNER JOIN `state`  ON `state`.`allState_Id`=`city`.state_id";
    $result = $conn->query($sql);

    while ($state_array = mysqli_fetch_array($result)) {
        $stateData[] = $state_array;
    }
    return $stateData;
}
