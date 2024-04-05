<?php

session_start();
require_once("./Connection.php");
date_default_timezone_set('Asia/Colombo');

if (isset($_POST['submit'])) {
    $userId = $_POST['u_id'];

    $delete_sql = "DELETE FROM `Users` WHERE u_id = :userid";
    $delete_smtp = $conn ->prepare($delete_sql);

    $delete_smtp -> bindParam(":userid", $userId);
    $delete_smtp -> execute();

        echo "Data inserted successfully.";
            $_SESSION['user_deleted'] = 1;
            $_SESSION['dataDeleted'] = false;
            header("Location: ../UserPages/UserPage.php");
    
}

?>