<?php
session_start();
require_once('./Connection.php');

if(isset($_POST['login'])) {
    
    $userMail = $_POST['username'];
    $userPass = $_POST['password'];

    echo $userMail;

    // Prepare the SQL statement with a placeholder for userMail
    $sql = "SELECT * FROM Users WHERE u_email = :userMail";

    try {
        $result = $conn->prepare($sql);
        // Bind the value of userMail to the placeholder
        $result->bindParam(':userMail', $userMail);
        $result->execute();
    
        if ($result->rowCount() > 0) {
            $row = $result->fetch(PDO::FETCH_ASSOC);
            $dbPass =  $row['u_password'];

            if($userPass == $dbPass){
                $_SESSION['user'] = $userMail;
                $_SESSION['userStarted'] = 1;
                $_SESSION['loginSuccessDisplayed'] = false;
                header("Location: ../UserPages/UserPage.php");
            }else{
                header("Location: ../index.php");
                $_SESSION["user"] = null;
                $_SESSION['userUnSet_p'] = 1;
            }
        } else {
            $_SESSION['userUnSet_e'] = 1;
            header("Location: ../index.php");
            
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

}

?>
