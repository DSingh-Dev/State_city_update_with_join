<?php
include('./php_functions/functions.php');
$delete_id = $_GET['id'];
$conn = dbConnection();
if (!empty($delete_id)) {
    try {

        $conn->query("DELETE FROM `store_address` WHERE `Id` = $delete_id");
        header('location: index.php');
    } catch (Exception $e) {
        echo "Delete Record failed: " . $e->getMessage();
    }
}
