<?php


session_start();
require_once("./Connection.php");
date_default_timezone_set('Asia/Colombo');

if(isset($_POST["remainder_submit"])){
    $createdBy = $_POST["r_createdby"];
    $reminder = $_POST["remainder"];
    $importancy = $_POST["remainder_important"];
    echo $createdBy;

    $sql_r = "INSERT INTO `reminders`( `r_created_by`, `r_data`, `r_important`)
     VALUES (:createdBy,:reminder,:importancy)";

     $smtp_rm = $conn->prepare($sql_r);

     $smtp_rm->bindParam(":createdBy", $createdBy);
     $smtp_rm->bindParam(":reminder", $reminder);
     $smtp_rm->bindParam(":importancy", $importancy);

     //execute
     $smtp_rm->execute();

        
        $_SESSION['inserted'] = 1;
        $_SESSION['dataInserted'] = false;
        header("Location: ../UserPages/UserPage.php");
    
}