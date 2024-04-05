<?php

session_start();
require_once("./Connection.php");
date_default_timezone_set('Asia/Colombo');

if (isset($_POST['delete_r'])) {
    $userId = $_POST['r_id'];

    $delete_sql = "DELETE FROM `reminders` WHERE r_id = :userid";
    $delete_smtp = $conn ->prepare($delete_sql);

    $delete_smtp -> bindParam(":userid", $userId);
    $delete_smtp -> execute();

        echo "Data inserted successfully.";
            $_SESSION['remind_delete'] = 1;
            $_SESSION['RemindDelete'] = false;
            header("Location: ../UserPages/UserPage.php");
    
}

