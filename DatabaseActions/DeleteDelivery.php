<?php


session_start();
require_once("./Connection.php");
date_default_timezone_set('Asia/Colombo');


if (isset($_POST['ddelete'])) {
    $userId = $_POST['d_id'];

    $delete_sql = "DELETE FROM `Delivery_arraange` WHERE ar_id = :userid";
    $delete_smtp = $conn ->prepare($delete_sql);

    $delete_smtp -> bindParam(":userid", $userId);
    $delete_smtp -> execute();

        echo "Data inserted successfully.";
            $_SESSION['user_deleted'] = 1;
            $_SESSION['dataDeleted'] = false;
            header("Location: ../UserPages/UserPage.php");
    
}




?>