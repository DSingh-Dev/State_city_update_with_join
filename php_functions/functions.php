<?php
//Database Connection
function dbConnection() {
    $db = new mysqli("192.168.1.63", 'dharmendra', 'ubuy@123', 'dharmendra_test');
    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }
    return $db;
}
