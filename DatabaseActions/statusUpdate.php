<?php
session_start();
require_once("./Connection.php");
date_default_timezone_set('Asia/Colombo');


if(isset($_POST["submited"])){
    $id = $_POST["id"];
    $status = $_POST["statusss"];


    $sqlis = "UPDATE `Delivery_arraange` SET `ar_status`=:statusd WHERE ar_id  = :arid ";
    $status_smtp = $conn->prepare($sqlis);
    $status_smtp->bindParam(":statusd", $status);
    $status_smtp->bindParam(":arid", $id);

    $status_smtp->execute();


    $_SESSION['status'] = 1;
    $_SESSION['dataStatus'] = false;
    $_SESSION["Actives"] = 1;
    header("Location: ../UserPages/UserPage.php");
}



?>