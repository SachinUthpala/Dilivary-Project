<?php
session_start();
require_once("../DatabaseActions/Connection.php");
date_default_timezone_set('Asia/Colombo');
// Check if user is logged in and userSet session variable is set
if (!isset($_SESSION['user'])){
    header("Location: ../index.php");
    exit; // Exit to prevent further execution
}

$ids = $_POST['deliveryId'];
$resent_sql = "SELECT * FROM Delivery_arraange WHERE ar_id = :ids";
$resent_smtp = $conn -> prepare($resent_sql);
$resent_smtp->bindParam(":ids", $ids);
$resent_smtp->execute();

$delivery = $resent_smtp->fetch(PDO::FETCH_ASSOC);


$reqPerson_SQl = "SELECT * FROM RequestedBy";
$req_person = $conn -> prepare($reqPerson_SQl);
$req_person->execute();
$allreq_person = $req_person->rowCount();



$type = "SELECT * FROM delivery_types";
$del_type = $conn -> prepare($type);
$del_type->execute();
$allreq_person = $del_type->rowCount();

$_SESSION['update_delivery_page_visited'] = 1;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Delivery</title>

    <style>
       
       *{
        box-sizing: border-box;
        font-family: 'Poppins', sans-serif;
       }
       
       body{
        width: 100%;
        height: 100vh;
       }

.container{
    max-width: 1000px;
    width: 100%;
    border-radius: 6px;
    background-color: #fff;
    margin: 0 15px;
    padding: 30px;

}

.container header{
    font-size: 20px;
    font-weight: 600;
    color: #333;
}

.container form{
    position: relative;
    min-height: 490px;
    margin-top: 16px;
    background-color: #fff;
    
}

.container form .details{
    margin-top: 10px;
}

.container form .title{
    font-size: 16px;
    font-weight: 500;
    margin: 6px 0;
    color: #333;
}


.container form .feilds{
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
}


.container form .input-feilds{
    display: flex;
    width: calc(100% / 3 - 15px);
    flex-direction: column;
    margin-top: 20px;
}

.input-feilds label{
    font-size: 12px;
    font-weight: 500;
    color: #2e2e2e;
}

.input-feilds input{
    outline: none;
    font-size: 14px;
    font-weight: 400px;
    border-radius: 5px;
    border: 1px solid #aaa;
    color: #333;
    height: 42px;
    margin: 8px 0;
    padding: 0px 10px;
}

.input-feilds input:is(:focus , :valid){
    box-shadow: 0 3px 6px rgba(0, 0, 0, 0.13) ;
}

.input-feilds input[type = "date"]{
    color: #707070;
}

.input-feilds input[type = "date"]:valid{
    color: #333;
}

.input-feilds select{
    outline: none;
    font-size: 14px;
    font-weight: 400px;
    border-radius: 5px;
    border: 1px solid #aaa;
    color: #333;
    height: 42px;
    margin: 8px 0;
    padding: 0px 10px;
}
.container form button{
    display: flex;
    align-items: center;
    justify-content: center;
    height: 45px;
    max-width: 200px;
    width: 100%;
    border: none;
    outline: none;
    color: #fff;
    border-radius: 5px;
    margin: 25px 0px;
    cursor: pointer;
}

.btns{
    display: flex;
    gap: 20px;
}

.submits{
    background: rgb(18, 18, 250);transition: 0.5s ease-in;
}

.submits:hover{
    background: rgb(56, 56, 255) ; 
}

.cancel{
    background: rgb(255, 0, 98);transition: 0.5s ease-in;
}

.cancel:hover{
    background: rgb(255, 31, 117);
}
    </style>
</head>
<body>
 
            <div class="container">
                <header>Update Delivery Arrangement</header>

                <form action="../DatabaseActions/Delivery.php" method="post">
                    <div class="form first">
                        <div class="details personal">
                            <span class="title">Primary Details</span>
                            <br><br>
                            <div class="feilds">
                                <div class="input-feilds">
                                <label>Delivery Id</label>
                                    <input type="hidden" value="<?php echo $ids ; ?>" name="delivryId" id="#" >
                                    <input type="text" value="<?php echo $ids ; ?>"  id="#" disabled >
                                </div>
                                <div class="input-feilds">
                                    <label>Date</label>
                                    <input type="date" value="<?php echo $delivery['ar_created_date'] ; ?>" name="date" id="#" disabled>
                                </div>
                                <div class="input-feilds">
                                    <label>Time</label>
                                    <input type="time" value="<?php echo  $delivery['ar_created_time']; ?>" name="#" id="#" disabled>
                                </div>
                                <div class="input-feilds">
                                    <label>DN Refference</label>
                                    <input type="text" name="dn" id="#"  value="<?php echo $delivery['ar_dn_ref']?>">
                                </div>
                                <div class="input-feilds">
                                    <label>Customer Name</label>
                                    <input type="text" name="customer_name" id="#" required value="<?php echo $delivery['ar_customer_name']?>">
                                </div>
                                <div class="input-feilds">
                                    <label>Delivery  Address</label>
                                    <input type="text" name="delivery_address" id="#" required value="<?php echo $delivery['ar_delivery_address']?>">
                                </div>
                                <div class="input-feilds">
                                    <label>Contact Number</label>
                                    <input type="text" name="contact_number" id="#" required value="<?php echo $delivery['ar_contact_number']?>">
                                </div>
                                <div class="input-feilds">
                                    <label>Contact Person</label>
                                    <input type="text" name="contaced_peson" id="#" required value="<?php echo $delivery['ar_contaced_person']?>">
                                </div>
                                <div class="input-feilds">
                                    <label>Type of Delivery</label>
                                    <select name="type_of_delivery" required value="<?php echo $delivery['ar_type_of_delivery']?>">
                                    <option value="<?php echo $delivery['ar_type_of_delivery']?>"><?php echo $delivery['ar_type_of_delivery']?></option>
                                    <?php while($del_type_row = $del_type->fetch(PDO::FETCH_ASSOC)){ ?>
                                        <option value="<?php echo $del_type_row['dType'] ; ?>"><?php echo $del_type_row['dType'] ; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="input-feilds">
                                    <label>Delivery Person </label>
                                    <input type="text" name="delivery_person" id="#" disabled value="<?php echo $delivery['ar_delivery_person']?>">
                                </div>
                                <div class="input-feilds">
                                    <label>Requested By</label>
                                    <select name="requested_by" required value="<?php echo $delivery['ar_requested_by']?>">
                                    <option value="<?php echo $delivery['ar_requested_by']?>"><?php echo $delivery['ar_requested_by']?></option>
                                    <?php while($all_REQ_rows = $req_person->fetch(PDO::FETCH_ASSOC)){ ?>
                                        <option value="<?php echo $all_REQ_rows['rName'] ; ?>"><?php echo $all_REQ_rows['rName'] ; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="input-feilds">
                                    <label>Vehicle Type</label>
                                    <select name="vehicle_type" required value="<?php echo $delivery['ar_vehicle_type']?>">
                                        <option value="<?php echo $delivery['ar_vehicle_type']?>"><?php echo $delivery['ar_vehicle_type']?></option>
                                        <option value="Bike">Bike</option>
                                        <option value="Lorry">Lorry</option>
                                        <option value="Car">Car</option>
                                        <option value="Van">Van</option>
                                        <option value="Bus">Bus</option>
                                        <option value="Airplane">Airplane</option>
                                    </select>
                                </div>
                                <div class="input-feilds">
                                    <label>Urgancy of deivery</label>
                                    <select name="uragncy" required value="<?php echo $delivery['ar_urgancy']?>">
                                        <option value="<?php echo $delivery['ar_urgancy']?>"><?php echo $delivery['ar_urgancy']?></option>
                                        <option value="Sheduled">Sheduled</option>
                                        <option value="Not Urgent">Not Urgent</option>
                                        <option value="Urgent">Urgent</option>
                                        <option value="Very Urgent">Very Urgent</option>
                                    </select>
                                </div>
                                <div class="input-feilds">
                                    <label>Add Remark </label>
                                    <input type="text" name="delivery_remark" id="#" width="200px" value="<?php echo $delivery['ar_remark']?>">
                                </div>
                                <div class="input-feilds">
                                    <label>Expected delivery date</label>
                                    <input type="date" value="<?php echo $delivery['ar_created_date'] ; ?>" name="exp_date" id="#" value="<?php echo $delivery['exp_del_date']?>" >
                                </div>
                            </div>

                            <div class="btns">
                                <button type="submit" name="submit_update" class="nxtBtn submits">
                                    <span class="btnText" ></span>Update Delivery</span>
                                </button>

                                <button type="button" class="nxtBtn cancel" onclick="location.href='./UserPage.php'">
                                    <span class="btnText" ></span>Cancel</span>
                                </button>
                                
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        
</body>
</html>