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
            $_SESSION['Delete_deliery'] = 1;
            $_SESSION['Deletedeliery'] = false;
            $_SESSION["Actives"] = 1;
            header("Location: ../UserPages/UserPage.php");
    
}




?>