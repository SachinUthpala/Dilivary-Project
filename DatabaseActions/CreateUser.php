<?php
session_start();
require_once("./Connection.php");
date_default_timezone_set('Asia/Colombo');

if(isset($_POST['submits'])){
    try{

        $userName = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $adminAss = intval($_POST['admin_access']);


        echo $adminAss , $userName;

        $addUser_sql = "INSERT INTO `Users`( `u_name`, `u_email`, `u_password`, `u_admin_access`) VALUES (:u_name , :u_email , :u_password , :u_admin_access)";
        $addUserSmtp = $conn->prepare($addUser_sql);

        //bindparams
        $addUserSmtp->bindParam(":u_name" , $userName);
        $addUserSmtp->bindParam(":u_email" , $email);
        $addUserSmtp->bindParam(":u_password" , $password);
        $addUserSmtp->bindParam(":u_admin_access" , $adminAss);

        $addUserSmtp->execute();

        //cheack if query works

        if($addUserSmtp->rowCount() > 0){
            echo "User added";
            $_SESSION['addUser'] = 1;
            $_SESSION['userInserted'] = false;
            header("Location: ../UserPages/UserPage.php");
        }else{
            echo "Error: Failed to insert data.";
            $_SESSION['unInserted'] = 1;
            header("Location: ../UserPages/UserPage.php");
        }

    }catch(Exception $e){
        echo ''.$e->getMessage().'';
    }
}


if(isset($_POST['req_person'])){
    try{

        $userName = $_POST['username'];


        echo $adminAss , $userName;

        $addUser_sql = "INSERT INTO `RequestedBy`( `rName`) VALUES (:req_by)";
        $addUserSmtp = $conn->prepare($addUser_sql);

        //bindparams
        $addUserSmtp->bindParam(":req_by" , $userName);

        $addUserSmtp->execute();

        //cheack if query works

        if($addUserSmtp->rowCount() > 0){
            echo "User added";
            $_SESSION['addUser'] = 1;
            $_SESSION['userInserted'] = false;
            header("Location: ../UserPages/UserPage.php");
        }else{
            echo "Error: Failed to insert data.";
            $_SESSION['unInserted'] = 1;
            header("Location: ../UserPages/UserPage.php");
        }

    }catch(Exception $e){
        echo ''.$e->getMessage().'';
    }
}

?>