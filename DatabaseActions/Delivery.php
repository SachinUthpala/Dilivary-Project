<?php
session_start();
require_once("./Connection.php");
date_default_timezone_set('Asia/Colombo');


if(isset($_POST["submit"])) {
    try {
        $date = $_POST['date'];
        $dn = $_POST['dn'];
        $customer_name = $_POST['customer_name'];
        $delivery_address = $_POST['delivery_address'];
        $contact_person = $_POST['contaced_peson']; // Fixed typo
        $contact_number = $_POST['contact_number']; // Fixed variable name
        $requested_by = $_POST['requested_by'];
        $vehicle_type = $_POST['vehicle_type'];
        $type_of_delivery = $_POST['type_of_delivery'];
        $urgency = $_POST['uragncy']; // Fixed variable name
        $delivery_person = $_POST['delivery_person'];
        $ar_created_by = $_SESSION['user'];
        $ar_created_date = date("Y-m-d");
        $ar_created_time = date('H:i:s');
        $exp_date = $_POST['exp_date'];
        $remark = $_POST['delivery_remark'];

        echo $ar_created_time;

        

        // Prepare the SQL query using prepared statements with named placeholders
        $sql = "INSERT INTO `Delivery_arraange`(`ar_date`, `ar_dn_ref`, `ar_customer_name`, `ar_delivery_address`, `ar_contaced_person`, 
                `ar_requested_by`, `ar_vehicle_type`, `ar_type_of_delivery`, `ar_urgancy`, `ar_delivery_person`, `ar_contact_number`, `ar_created_by`, 
                `ar_created_date` , `ar_created_time` , `exp_del_date` , `ar_remark`) 
                VALUES (:ar_date, :ar_dn_ref, :ar_customer_name, :ar_delivery_address, :ar_contaced_person, 
                :ar_requested_by, :ar_vehicle_type, :ar_type_of_delivery, :ar_urgancy, :ar_delivery_person, :ar_contact_number, :ar_created_by, 
                :ar_created_date , :ar_created_time , :exp_date , :ar_remark)";

        $stmt = $conn->prepare($sql);

        // Bind parameters
        $stmt->bindParam(":ar_date", $ar_created_date);
        $stmt->bindParam(":ar_dn_ref", $dn);
        $stmt->bindParam(":ar_customer_name", $customer_name);
        $stmt->bindParam(":ar_delivery_address", $delivery_address);
        $stmt->bindParam(":ar_contaced_person", $contact_person);
        $stmt->bindParam(":ar_requested_by", $requested_by);
        $stmt->bindParam(":ar_vehicle_type", $vehicle_type);
        $stmt->bindParam(":ar_type_of_delivery", $type_of_delivery);
        $stmt->bindParam(":ar_urgancy", $urgency);
        $stmt->bindParam(":ar_delivery_person", $delivery_person);
        $stmt->bindParam(":ar_contact_number", $contact_number);
        $stmt->bindParam(":ar_created_by", $ar_created_by);
        $stmt->bindParam(":ar_created_date", $ar_created_date);
        $stmt->bindParam(":ar_created_time", $ar_created_time);
        $stmt->bindParam(":exp_date", $exp_date);
        $stmt->bindParam(":ar_remark", $remark);

        // Execute the statement
        $stmt->execute();

        // Check if the query was executed successfully
        if ($stmt->rowCount() > 0) {
            echo "Data inserted successfully.";

            
            $_SESSION['inserted'] = 1;
            $_SESSION['dataInserted'] = false;
            header("Location: ../UserPages/UserPage.php");
        } else {
            echo "Error: Failed to insert data.";
            $_SESSION['unInserted'] = 1;
            header("Location: ../UserPages/UserPage.php");
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    } 
}



if(isset($_POST['delivery_type'])){
    try {
        

        $names = $_POST['del_t'];

    $sqli = "INSERT INTO `delivery_types`( `dType`) VALUES (:typess)";

    $smtpss = $conn -> prepare($sqli);
    $smtpss->bindParam(":typess", $names);

    $smtpss->execute();

        // Check if the query was executed successfully
        if ($smtpss->rowCount() > 0) {
            echo "Data inserted successfully.";

            
            $_SESSION['inserted'] = 1;
            $_SESSION['dataInserted'] = false;
            header("Location: ../UserPages/UserPage.php");
        } else {
            echo "Error: Failed to insert data.";
            $_SESSION['unInserted'] = 1;
            header("Location: ../UserPages/UserPage.php");
        }





    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}



if(isset($_POST["submit_update"])){
       
        $dn = $_POST['dn'];
        $customer_name = $_POST['customer_name'];
        $delivery_address = $_POST['delivery_address'];
        $contact_person = $_POST['contaced_peson']; // Fixed typo
        $contact_number = $_POST['contact_number']; // Fixed variable name
        $requested_by = $_POST['requested_by'];
        $vehicle_type = $_POST['vehicle_type'];
        $type_of_delivery = $_POST['type_of_delivery'];
        $urgency = $_POST['uragncy']; // Fixed variable name
        $exp_date = $_POST['exp_date'];
        $remark = $_POST['delivery_remark'];
        $id_devlivery = $_POST['delivryId'];

        echo $id_devlivery;
         

        $up_sql = "UPDATE `Delivery_arraange` SET `ar_dn_ref`=:dn,`ar_customer_name`=:ar_customer_name,`ar_delivery_address`=:ar_delivery_address,
        `ar_contaced_person`=:ar_contaced_person,`ar_requested_by`= :ar_requested_by,`ar_vehicle_type`=:ar_vehicle_type,`ar_type_of_delivery`=:ar_type_of_delivery,
        `ar_urgancy`=:ar_urgancy,`ar_contact_number`=:ar_contact_number,`exp_del_date`=:exp_del_date,`ar_remark`=:ar_remark WHERE ar_id = :id";

        $stmt_update = $conn->prepare($up_sql);

        $stmt_update->bindParam(":dn" , $dn);
        $stmt_update->bindParam(":ar_customer_name" , $customer_name);
        $stmt_update->bindParam(":ar_delivery_address" , $delivery_address);
        $stmt_update->bindParam(":ar_contaced_person" , $contact_person);
        $stmt_update->bindParam(":ar_requested_by" , $requested_by);
        $stmt_update->bindParam(":ar_vehicle_type" , $vehicle_type);
        $stmt_update->bindParam(":ar_type_of_delivery" , $type_of_delivery);
        $stmt_update->bindParam(":ar_urgancy" , $urgency);
        $stmt_update->bindParam(":ar_contact_number" , $contact_number);
        $stmt_update->bindParam(":exp_del_date" , $exp_date);
        $stmt_update->bindParam(":ar_remark" , $remark);
        $stmt_update->bindParam(":id" , $id_devlivery);

        try {
            $stmt_update->execute();
            $_SESSION['status'] ==1;
            $_SESSION['dataInserted'] == true;
            $_SESSION['update_delivery_page_visited'] = 1;
            header("Location: ../UserPages/UserPage.php");
        } catch (\Throwable $th) {
            echo $th;
        }
}