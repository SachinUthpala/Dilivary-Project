<?php

session_start();
require_once("./Connection.php");
date_default_timezone_set('Asia/Colombo');

if (isset($_POST["issubmited"])) {
    $id = $_POST["id"];
    $status = $_POST["intime"];

    $sqlis = "UPDATE `Delivery_arraange` SET `ar_out_time`=:statusd WHERE ar_id  = :arid";
    $status_smtp = $conn->prepare($sqlis);
    $status_smtp->bindParam(":statusd", $status);
    $status_smtp->bindParam(":arid", $id);

    $status_smtp->execute();

    $_SESSION['time'] = 1;
    $_SESSION['dataTime'] = false;
    header("Location: ../UserPages/UserPage.php");
} elseif (isset($_POST["Outsubmited"])) {
    $id = $_POST["id"];
    $status = $_POST["outtime"];

    $sqlis = "UPDATE `Delivery_arraange` SET `ar_in_time`=:statusd WHERE ar_id  = :arid";
    $status_smtp = $conn->prepare($sqlis);
    $status_smtp->bindParam(":statusd", $status);
    $status_smtp->bindParam(":arid", $id);

    $status_smtp->execute();

    $_SESSION['time'] = 1;
    $_SESSION['dataTime'] = false;
    header("Location: ../UserPages/UserPage.php");
}elseif (isset($_POST["perdon"])) {
    $id = $_POST["id"];
    $status = $_POST["persons"];

    $sqlis = "UPDATE `Delivery_arraange` SET `ar_delivery_person`=:statusd WHERE ar_id  = :arid";
    $status_smtp = $conn->prepare($sqlis);
    $status_smtp->bindParam(":statusd", $status);
    $status_smtp->bindParam(":arid", $id);

    $status_smtp->execute();

    $_SESSION['time'] = 1;
    $_SESSION['dataTime'] = false;
    header("Location: ../UserPages/UserPage.php");
}
?>
