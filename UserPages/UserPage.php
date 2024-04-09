<?php

session_start();
require_once("../DatabaseActions/Connection.php");
date_default_timezone_set('Asia/Colombo');
// Check if user is logged in and userSet session variable is set
if (!isset($_SESSION['user'])){
    header("Location: ../index.php");
    exit; // Exit to prevent further execution
}

$mail = $_SESSION['user'];

// Sanitize user input to prevent SQL injection
$mail = htmlspecialchars($mail);

// Prepare SQL statement with placeholders
$sql = "SELECT * FROM Users WHERE u_email = :mail";

try {
    // Prepare and execute the SQL statement
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':mail', $mail);
    $stmt->execute();

    // Check if there are any rows returned
    if($stmt->rowCount() > 0){
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $admin_Access = $row['u_admin_access'];
        $user_name = $row['u_name'];
        // Do something with $admin_Access if needed
    }
    else {
        // Handle case where no user is found with the provided email
        // Redirect or show an error message
    }
} catch (PDOException $e) {
    // Handle database errors
    echo "Error: " . $e->getMessage();
}

if(isset($_SESSION['loginSuccessDisplayed']) && $_SESSION['loginSuccessDisplayed'] == true) {
    $loginSuccessDisplayed = true;
} else {
    $loginSuccessDisplayed = false;
}

if(isset($_SESSION['dataInserted']) && $_SESSION['dataInserted'] == true) {
    $dataInserted = true;
} else {
    $dataInserted = false;
}

if(isset($_SESSION['userInserted']) && $_SESSION['userInserted'] == true) {
    $userInserted = true;
} else {
    $userInserted = false;
}

if(isset($_SESSION['dataDeleted']) && $_SESSION['dataDeleted'] == true) {
    $dataDeleted = true;
} else {
    $dataDeleted = false;
}

if(isset($_SESSION['dataStatus']) && $_SESSION['dataStatus'] == true) {
    $dataStatus = true;
} else {
    $dataStatus = false;
}


if(isset($_SESSION['dataTime']) && $_SESSION['dataTime'] == true) {
    $dataTime = true;
} else {
    $dataTime = false;
}

if(isset($_SESSION['dataTime']) && $_SESSION['dataTime'] == true) {
    $dataTime = true;
} else {
    $dataTime = false;
}

if(isset($_SESSION['RemindDelete']) && $_SESSION['RemindDelete'] == true) {
    $RemindDelete = true;
} else {
    $RemindDelete = false;
}

if(isset($_SESSION['Deletedeliery']) && $_SESSION['Deletedeliery'] == true) {
    $Deletedeliery = true;
} else {
    $Deletedeliery = false;
}


date_default_timezone_set('Asia/Colombo');

$ar_created_date = date("Y-m-d");
$ar_created_time = date('H:i:s');



//for delivary notes
$delivery_sql = "SELECT * FROM Delivery_arraange WHERE ar_created_by = :ar_created_by";

try{
    $delivery_smtp = $conn -> prepare($delivery_sql);
    $delivery_smtp->bindParam(":ar_created_by", $mail);
    $delivery_smtp->execute();

    $delivayRow = $delivery_smtp->rowCount();
}catch (PDOException $e) {
    echo "Error". $e->getMessage();
}

//for resent orders

$resent_sql = "SELECT * FROM Delivery_arraange WHERE ar_created_by = :mails ORDER BY ar_id DESC LIMIT 5";
try{

    $resent_smtp = $conn -> prepare($resent_sql);
    $resent_smtp->bindParam(":mails", $mail);
    $resent_smtp->execute();

}catch (PDOException $e) {
    echo "Error". $e->getMessage();
}


//for user reminders
$reminder_sql = "SELECT * FROM reminders WHERE r_created_by = :r_created_by ORDER BY r_id DESC LIMIT 5"; 
try {
    $reminder_smtp = $conn -> prepare($reminder_sql);
    $reminder_smtp->bindParam(":r_created_by", $mail);
    $reminder_smtp->execute();
} catch (PDOException $e) {
    echo "Error". $e->getMessage();
}

//for ALL deliveries
$all_Del_sql = "SELECT * FROM Delivery_arraange WHERE ar_created_by = :mails ";
try{

    $all_del_smtp = $conn -> prepare($all_Del_sql);
    $all_del_smtp->bindParam(":mails", $mail);
    $all_del_smtp->execute();

}catch (PDOException $e) {
    echo "Error". $e->getMessage();
}



///for admin page reference/////////////////
//=========================================================================//

$allUserSql = "SELECT * FROM Users";

$all_user_smtp = $conn -> prepare($allUserSql);
$all_user_smtp->execute();
$all_users = $all_user_smtp->rowCount();


//all deliverys
$all_delivery_sql = "SELECT * FROM Delivery_arraange ORDER BY ar_id DESC";
$all_delivery_smtp = $conn -> prepare($all_delivery_sql);
$all_delivery_smtp->execute();
$all_deliveries = $all_delivery_smtp->rowCount();

//pdending
$all_delivery_sql_pending = "SELECT * FROM Delivery_arraange Where ar_status = 'pending'";
$all_delivery_sql_pending = $conn -> prepare($all_delivery_sql_pending);
$all_delivery_sql_pending->execute();
$all_Pending_deliveries = $all_delivery_sql_pending->rowCount();

//canceled
$all_delivery_sql_canceled = "SELECT * FROM Delivery_arraange Where ar_status = 'canceled'";
$all_delivery_sql_canceled = $conn -> prepare($all_delivery_sql_canceled);
$all_delivery_sql_canceled->execute();
$all_Canceled_deliveries = $all_delivery_sql_canceled->rowCount();

//delivered
$all_delivery_sql_delivered = "SELECT * FROM Delivery_arraange Where ar_status = 'delivered'";
$all_delivery_sql_delivered = $conn -> prepare($all_delivery_sql_delivered);
$all_delivery_sql_delivered->execute();
$all_delivered_deliveries = $all_delivery_sql_delivered->rowCount();

//all deleiversssss
//all deliverys
$all_delivery_sql2 = "SELECT * FROM Delivery_arraange ORDER BY ar_id DESC";
$all_delivery_smtp2 = $conn -> prepare($all_delivery_sql2);
$all_delivery_smtp2->execute();
$all_deliveries2 = $all_delivery_smtp2->rowCount();

//for analise orders
//all reqpersons
$reqPerson_SQl = "SELECT * FROM RequestedBy";
$req_person = $conn -> prepare($reqPerson_SQl);
$req_person->execute();
$allreq_person = $req_person->rowCount();


//delivery type

$type = "SELECT * FROM delivery_types";
$del_type = $conn -> prepare($type);
$del_type->execute();
$allreq_person = $del_type->rowCount();


//webdevelopers
$web_use_sql = 'SELECT * FROM `Users` WHERE u_email like "%WebDeveloper%" OR "%webdeveloper%";';
$web_use_sql_type = $conn -> prepare($web_use_sql);
$web_use_sql_type->execute();
$webdevelopercount = $web_use_sql_type->rowCount();


//accounting
$acc_use_sql = 'SELECT * FROM `Users` WHERE u_email like "%accounting%" OR "%Accounting%";';
$acc_use_sql_type = $conn -> prepare($acc_use_sql);
$acc_use_sql_type->execute();
$accdevelopercount = $acc_use_sql_type->rowCount();


//admins

$Admin_use_sql = 'SELECT * FROM `Users` WHERE u_email like "%accounting%" OR "%Accounting%";';
$Admin_use_sql_type = $conn -> prepare($Admin_use_sql);
$Admin_use_sql_type->execute();
$Admindevelopercount = $Admin_use_sql_type->rowCount();

//salseperson

$SalsePerson_use_sql = 'SELECT * FROM `Users` WHERE u_email like "%accounting%" OR "%Accounting%";';
$SalsePerson_use_sql_type = $conn -> prepare($SalsePerson_use_sql);
$SalsePerson_use_sql_type->execute();
$SalsePersondevelopercount = $SalsePerson_use_sql_type->rowCount();

//adminacc
$Admin_Acc_Avalable = $accdevelopercount + $webdevelopercount + $Admindevelopercount;
$Admin_Acc_not = $SalsePersondevelopercount;
//=======================================================================//


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="style.css">
    <title>East Link Engineering</title>


    <!--for sweet alert-->
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js" ></script>

    <!--charts-->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <a href="#" class="logo">
            <div class="logo-name"><span>East - </span>Link</div>
        </a>
        <ul class="side-menu">
            <li class="active" id="dsh"><a href="#" onclick="displayash()"><i class='bx bxs-dashboard'></i>Dashboard</a></li>
            <li class="" id="fr"><a href="#" onclick="displyforms()"><i class='bx bx-store-alt'></i>Create Delivery</a></li>
            <li class="" id="aDil"><a href="#" onclick="displayalldel()"><i class='bx bxs-package'></i>My Deliveries</a></li>
            <!--Admin Reference-->
            <li class="" id="add_user" <?php if($admin_Access == 1) {echo "style='display:block'";}else{echo "style='display:none'";}  ?> ><a href="#" onclick="displayAddUser()"><i class='bx bx-user-plus' ></i>Add User</a></li>
            <li class="" id="quickIntro" <?php if($admin_Access == 1) {echo "style='display:block'";}else{echo "style='display:none'";}  ?> ><a href="#" onclick="quickAna()"><i class='bx bxs-pie-chart-alt-2'></i>Quick Analisis</a></li>
            <li class="" id="all_del" <?php if($admin_Access == 1) {echo "style='display:block'";}else{echo "style='display:none'";}  ?> ><a href="#" onclick="diaplayAllUserDelivery()"><i class='bx bx-cog'></i></i>Update Deliveries</a></li>
            <li class="" id="all_del" <?php if($admin_Access == 1) {echo "style='display:block'";}else{echo "style='display:none'";}  ?> ><a href="#" onclick="diaplayAllUserDelivery2()"><i class='bx bxl-dropbox'></i>All Deliveries</a></li>
            <li class="" id="all_user" <?php if($admin_Access == 1) {echo "style='display:block'";}else{echo "style='display:none'";}  ?> ><a href="#" onclick="displayAllusers()"><i class='bx bxs-user-detail'></i>All Users</a></li>
            <li class="" id="all_user" <?php if($admin_Access == 1) {echo "style='display:block'";}else{echo "style='display:none'";}  ?> ><a href="#" onclick="displayAddReqPerosn()"><i class='bx bx-male-female' ></i>Add Requested Per..</a></li>
            <li class="" id="all_user" <?php if($admin_Access == 1) {echo "style='display:block'";}else{echo "style='display:none'";}  ?> ><a href="#" onclick="createDeliveryType()"><i class='bx bxl-docker' ></i>Add Delivery Type</a></li>
           
            <br><br>
            <li class="" id="all_user" <?php if($admin_Access == 1) {echo "style='display:block'";}else{echo "style='display:none'";}  ?> ><a href="#" onclick="displayAllPending()"><i class='bx bxs-time-five' ></i>Pending Orders</a></li>
            <li class="" id="all_user" <?php if($admin_Access == 1) {echo "style='display:block'";}else{echo "style='display:none'";}  ?> ><a href="#" onclick="displayAllCanceled()"><i class='bx bxs-bug'></i>Canceled Orders</a></li>
            <li class="" id="all_user" <?php if($admin_Access == 1) {echo "style='display:block'";}else{echo "style='display:none'";}  ?> ><a href="#" onclick="displayDelivered()"><i class='bx bxs-bell' ></i>Delivered Orders</a></li>
        </ul>
        <ul class="side-menu">
            <li>
                <a class="logout" style="cursor: pointer;" onclick="logoutfunction()">
                    <i class='bx bx-log-out-circle'></i>
                    Logout
                </a>
            </li>
        </ul>
    </div>
    <!-- End of Sidebar -->

    <!-- Main Content -->
    <div class="content" >
        <!-- Navbar -->
        <nav>
            
            <i class='bx bx-menu'></i>
            <form action="#">
                <div class="form-input">
                    <!-- <input type="search" placeholder="Search..."> -->
                    <button class="search-btn" style="display: none;" type="submit"><i class='bx bx-search'></i></button>
                </div>
            </form>
            <span style="color: #1976D2; font-size:15px; padding-left: 10px;font-weight:700;">Dark / Light Mode : </span>
            <input type="checkbox" id="theme-toggle" hidden>
            <label for="theme-toggle" class="theme-toggle"></label>
            <!-- <a href="#" class="notif">
                <i class='bx bx-bell'></i>
                <span class="count">12</span>
            </a> -->
            
        </nav>

        <!-- End of Navbar -->

        <main id="dashbord" <?php if($_SESSION['Actives'] != null){ echo 'style="display:none;"'; } ?>>
            <div class="header">
                <div class="left">
                    <h1>Dashboard</h1>
                    <ul class="breadcrumb">
                        <li><a href="#">
                                Analytics
                            </a></li>
                        /
                        <li><a href="#" class="active">Shop</a></li>
                    </ul>
                </div>
                
            </div>

            <!-- Insights -->
            <ul class="insights">
                <li>
                    <i class='bx bx-calendar-check'></i>
                    <span class="info">
                        <h3>
                            <?php echo $user_name; ?>
                        </h3>
                        <p>Logged In As</p>
                    </span>
                </li>
                <li><i class='bx bx-show-alt'></i>
                    <span class="info">
                        <h3>
                            <?php echo $delivayRow; ?>
                        </h3>
                        <p>Total Created Delivery Arrangements</p>
                    </span>
                </li>
                <li><i class='bx bx-line-chart'></i>
                    <span class="info">
                        <h3>
                            <?php echo $mail; ?>
                        </h3>
                        <p>My Mail</p>
                    </span>
                </li>
            </ul>
            <!-- End of Insights -->

            <div class="bottom-data">
                <div class="orders">
                    <div class="header">
                        <i class='bx bx-receipt'></i>
                        <h3>Recent Deliveries</h3>
                        <i class='bx bx-filter'></i>
                        <i class='bx bx-search'></i>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>DN</th>
                                <th>Customer Name</th>
                                <th>Contacted Person</th>
                                <th>Contact Number</th>
                                <th>Created Time</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($re_rows = $resent_smtp->fetch(PDO::FETCH_ASSOC)){ ?>
                            <tr>
                                <td> <?php echo $re_rows['ar_dn_ref']; ?> </td>
                                <td> <?php echo $re_rows['ar_customer_name']; ?> </td>
                                <td> <?php echo $re_rows['ar_contaced_person']; ?> </td>
                                <td> <?php echo $re_rows['ar_contact_number']; ?> </td>
                                <td> <?php echo $re_rows['ar_created_time']; ?> </td>
                                <td> <span class="status <?php if($re_rows['ar_status'] == 'pending'){echo 'pending';} else if($re_rows['ar_status'] == 'canceled'){echo 'process';}else if($re_rows['ar_status'] == 'delivered'){ echo 'completed';} ?>"><?php echo $re_rows['ar_status']; ?></span> </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
            </div>

            <!--reminders -->
                            <!-- Reminders -->
                <div class="reminders">
                    <div class="header">
                        <i class='bx bx-note'></i>
                        <h3>Reminders</h3>
                        <span style="display: flex; gap: 20px;">
                            <span style="display: flex; gap: 20px;"><i class='bx bx-badge-check' style='color:#388E3C'></i><p>Not Important</p></span>
                            <span style="display: flex; gap: 20px;"><i class='bx bxs-badge-check' style='color:#D32F2F;'></i><p>Important</p></span>
                        </span>
                        <i class='bx bx-plus' id="show-form"></i>
                    </div>
                    <ul class="task-list">
                        <?php while($reminder_row = $reminder_smtp->fetch(PDO::FETCH_ASSOC)) {?>
                        <li class="<?php if($reminder_row['r_important'] == "Important") {echo "not-completed";} else { echo "completed";} ?>">
                            <div class="task-title">
                                <?php if($reminder_row['r_important'] == "Important") {echo "<i class='bx bxs-badge-check' style='color:#D32F2F;'></i>";} else { echo "<i class='bx bx-badge-check' style='color:#388E3C'></i>";} ?>
                                <p><?php echo $reminder_row['r_data'];  ?></p>
                            </div>
                            <form action="../DatabaseActions/DeleteRemind.php" method="post">
                                <input type="hidden" value="<?php echo $reminder_row['r_id'];  ?>" name="r_id">
                                <button style="background: transparent;border: none; padding:5px" name="delete_r"><i class='bx bxl-xing'></i></button>
                            </form>
                        </li>
                        <?php } ?>
                    </ul>
                </div>

                <!-- End of Reminders-->


        </main>



            <!--add reminder form-->
            <div class="popup-form">
                    <div class="close-btn" id="close-form">&times;</div>
                    <div class="form">
                        <h2>Add Reminder</h2>
                        <form action="../DatabaseActions/Reminder.php" method="post">
                            <input type="hidden" name="r_createdby" value="<?php echo $_SESSION['user']; ?>">
                            <div class="form-element">
                                <label for="remainder">Your Reminder</label>
                                <input type="text" name="remainder" id="remainder">
                            </div>
                            <div class="form-element">
                                <label for="remainder">Importance</label>
                                <select name="remainder_important" id="#">
                                    <option name="#" value="Important" id="#">Important</option>
                                    <option name="#" value="Not_Important" id="#">Not Important</option>
                                </select>
                            </div>
                            <div class="form-element">
                                <button type="submit" name="remainder_submit">Add Reminder</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!--script for form-->

                <script>
                    document.querySelector("#show-form").addEventListener("click" , function(){
                        document.querySelector(".popup-form").classList.add("active")
                    });

                    document.querySelector("#close-form").addEventListener("click" , function(){
                        document.querySelector(".popup-form").classList.remove("active")
                    });
                </script>

        <!--form for insert data-->

        <main id="forms"> 
            <div class="container">
                <header>Create Delivery Arrangement</header>

                <form action="../DatabaseActions/Delivery.php" method="post">
                    <div class="form first">
                        <div class="details personal">
                            <span class="title">Primary Details</span>
                            <br><br>
                            <div class="feilds">
                                <div class="input-feilds">
                                    <label>Date</label>
                                    <input type="date" value="<?php echo $ar_created_date ; ?>" name="date" id="#" disabled>
                                </div>
                                <div class="input-feilds">
                                    <label>Time</label>
                                    <input type="time" value="<?php echo  $ar_created_time; ?>" name="#" id="#" disabled>
                                </div>
                                <div class="input-feilds">
                                    <label>DN Refference</label>
                                    <input type="text" name="dn" id="#" required>
                                </div>
                                <div class="input-feilds">
                                    <label>Customer Name</label>
                                    <input type="text" name="customer_name" id="#" required>
                                </div>
                                <div class="input-feilds">
                                    <label>Delivery  Address</label>
                                    <input type="text" name="delivery_address" id="#" required>
                                </div>
                                <div class="input-feilds">
                                    <label>Contact Number</label>
                                    <input type="text" name="contact_number" id="#" required>
                                </div>
                                <div class="input-feilds">
                                    <label>Contact Person</label>
                                    <input type="text" name="contaced_peson" id="#" required>
                                </div>
                                <div class="input-feilds">
                                    <label>Type of Delivery</label>
                                    <select name="type_of_delivery" required>
                                    <?php while($del_type_row = $del_type->fetch(PDO::FETCH_ASSOC)){ ?>
                                        <option value="<?php echo $del_type_row['dType'] ; ?>"><?php echo $del_type_row['dType'] ; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="input-feilds">
                                    <label>Delivery Person </label>
                                    <input type="text" name="delivery_person" id="#" disabled>
                                </div>
                                <div class="input-feilds">
                                    <label>Requested By</label>
                                    <select name="requested_by" required>
                                    <?php while($all_REQ_rows = $req_person->fetch(PDO::FETCH_ASSOC)){ ?>
                                        <option value="<?php echo $all_REQ_rows['rName'] ; ?>"><?php echo $all_REQ_rows['rName'] ; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="input-feilds">
                                    <label>Vehicle Type</label>
                                    <select name="vehicle_type" required>
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
                                    <select name="uragncy" required>
                                        <option value="Sheduled">Sheduled</option>
                                        <option value="Not Urgent">Not Urgent</option>
                                        <option value="Urgent">Urgent</option>
                                        <option value="Very Urgent">Very Urgent</option>
                                    </select>
                                </div>
                                <div class="input-feilds">
                                    <label>Expected delivery date</label>
                                    <input type="date" value="<?php echo $ar_created_date ; ?>" name="exp_date" id="#" >
                                </div>
                            </div>

                            <div class="btns">
                                <button type="submit" name="submit" class="nxtBtn submits">
                                    <span class="btnText" ></span>Create Delivery</span>
                                </button>
                                
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </main>
        

        <!--for user all deliverys -->
        <main id="allDelivery"> 
                
            <div class="bottom-data">
    <div class="orders">
        <div class="header">
            <i class='bx bx-receipt'></i>
            <h3>All Created Deliveries</h3>
            <i class='bx bx-filter'></i>
            <a href="./userAllDetails.php" style="padding: 10px 20px; background:#1976D2;color: #fff;text-decoration: none;text-transform: uppercase;border-radius: 5px;">All Details</a>
            <input type="text" id="searchInput" style="padding: 8px 15px;font-size:16px" placeholder="Search...">
        </div>
        <table id="deliveryTable">
            <thead>
                <tr>
                    <th>DN</th>
                    <th>Customer Name</th>
                    <th>Urgency</th>
                    <th>Address</th>
                    <th>Created Time</th>
                    <th>Expected Delivery Date</th>
                    <th>Out Time</th>
                    <th>Delivery Person</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php while($all_rows = $all_del_smtp->fetch(PDO::FETCH_ASSOC)){ ?>
                <tr>
                    <td><?php echo $all_rows['ar_dn_ref']; ?></td>
                    <td><?php echo $all_rows['ar_customer_name']; ?></td>
                    <td><?php echo $all_rows['ar_urgancy']; ?></td>
                    <td><?php echo $all_rows['ar_delivery_address']; ?></td>
                    <td><?php echo $all_rows['ar_created_time']; ?></td>
                    <td><?php echo $all_rows['exp_del_date']; ?></td>
                    <td><?php echo $all_rows['ar_out_time']; ?></td>
                    <td><?php echo $all_rows['ar_delivery_person']; ?></td>
                    <td><span class="status <?php if($all_rows['ar_status'] == 'pending'){echo 'pending';} else if($all_rows['ar_status'] == 'canceled'){echo 'process';}else if($all_rows['ar_status'] == 'delivered'){ echo 'completed';} ?>"><?php echo $all_rows['ar_status']; ?></span></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    // Get the input field and table
    var input = document.getElementById("searchInput");
    var table = document.getElementById("deliveryTable");

    // Add event listener for input changes
    input.addEventListener("input", function() {
        // Get the filter value
        var filter = input.value.toUpperCase();

        // Get the table rows
        var rows = table.getElementsByTagName("tr");

        // Loop through all table rows, and hide those who don't match the search query
        for (var i = 0; i < rows.length; i++) {
            var cells = rows[i].getElementsByTagName("td");
            var found = false;
            for (var j = 0; j < cells.length; j++) {
                var cell = cells[j];
                if (cell) {
                    var txtValue = cell.textContent || cell.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        found = true;
                        break;
                    }
                }
            }
            if (found) {
                rows[i].style.display = "";
            } else {
                rows[i].style.display = "none";
            }
        }
    });
</script>


        </main>

        <!--for add a user -->
        <main id="Adduser_form"> 
            <div class="container">
                <header>Add User</header>

                <form action="../DatabaseActions/CreateUser.php" method="post">
                    <div class="form first">
                        <div class="details personal">
                            <span class="title">Add User</span>
                            <br><br>
                            <div class="feilds">
                                <div class="input-feilds">
                                    <label>Name</label>
                                    <input type="text" name="username" id="#" >
                                </div>
                                <div class="input-feilds">
                                    <label>Email</label>
                                    <input type="email" name="email" id="#" >
                                </div>
                                <div class="input-feilds">
                                    <label>Password</label>
                                    <input type="text" name="password" id="#">
                                </div>
                                <div class="input-feilds">
                                    <label>Admin Access</label>
                                    <select name="admin_access">
                                        <option value="0">No</option>
                                        <option value="1">Yes</option>
                                    </select>
                                </div>
                            </div>

                            <div class="btns">
                                <button type="submit" class="nxtBtn submits" name="submits">
                                    <span class="btnText" ></span>Create User</span>
                                </button>
                                
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </main>

        <!--create a delivery type -->
        <main id="delivery_type"> 
            <div class="container">
                <header>Add Delivery Type</header>

                <form action="../DatabaseActions/Delivery.php" method="post">
                    <div class="form first">
                        <div class="details personal">
                            <span class="title">Add Delivery Type</span>
                            <br><br>
                            <div class="feilds">
                                <div class="input-feilds">
                                    <label>Create Delivery type</label>
                                    <input type="text" name="del_t" id="#" >
                                </div>
                            </div>

                            <div class="btns">
                                <button type="submit" class="nxtBtn submits" name="delivery_type">
                                    <span class="btnText" ></span>Add Delivery Type</span>
                                </button>
                                
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </main>


        <!--add New requested person -->
        <main id="req_person"> 
            <div class="container">
                <header>Add User</header>

                <form action="../DatabaseActions/CreateUser.php" method="post">
                    <div class="form first">
                        <div class="details personal">
                            <span class="title">Add User</span>
                            <br><br>
                            <div class="feilds">
                                <div class="input-feilds">
                                    <label>Name</label>
                                    <input type="text" name="username" id="#" >
                                </div>
                            </div>

                            <div class="btns">
                                <button type="submit" class="nxtBtn submits" name="req_person">
                                    <span class="btnText" ></span>Add User</span>
                                </button>
                                
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </main>

        <!--display all users and update-->

        <main id="allusers"> 
                
            <div class="bottom-data">
                <div class="orders">
                    <div class="header">
                        <i class='bx bx-receipt'></i>
                        <h3>All System Users</h3>
                        <i class='bx bx-filter'></i>
                        <i class='bx bx-search'></i>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>User Id</th>
                                <th>User Name</th>
                                <th>User Email</th>
                                <th>User Password</th>
                                <th>Delete User</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($all_user_rows = $all_user_smtp->fetch(PDO::FETCH_ASSOC)){ ?>
                            <tr>
                                <td> <?php echo $all_user_rows['u_id']; ?> </td>
                                <td> <?php echo $all_user_rows['u_name']; ?> </td>
                                <td> <?php echo $all_user_rows['u_email']; ?> </td>
                                <td> <?php echo $all_user_rows['u_password']; ?> </td>
                                <td>
                                    <form action="../DatabaseActions/DeleteUser.php" method="post">
                                        <input type="hidden" name="u_id" value="<?php echo $all_user_rows['u_id']; ?>">
                                        <button type="submit" value="Delete" name="submit" style="background:rgb(255, 0, 98);color:#fff;font-size:15px;border:none;cursor:pointer;padding:8px 16px;border-radius:5px">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
            </div>

        </main>



        <!---update delivery status -->




        <main id="all_Users_Delivery" <?php if($_SESSION['Actives'] != null){ echo 'style="display:block;"'; $_SESSION['Actives'] = null; } ?>> 
    <div class="bottom-data">
        <div class="orders">
            <div class="header">
                <i class='bx bx-receipt'></i>
                <h3>Update Created Deliveries</h3>
                <i class='bx bx-filter'></i>
                <form id="filterForm">
                    <input type="text" id="filterInput" style="padding: 8px 15px;font-size:16px" placeholder="Filter by DN">
                </form>
            </div>
            <table id="deliveryTable">
                <thead>
                    <tr>
                        <th>DN</th>
                        <th>Customer</th>
                        <th>Requested By</th>
                        <th>Created Time</th>
                        <th>Status</th>
                        <th>Update Status</th>
                        <th>Out Time</th>
                        <th>In Time</th>
                        <th>Delivery Person</th>
                        <th>Remove Dlivery</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($all_del_rows = $all_delivery_smtp->fetch(PDO::FETCH_ASSOC)){ ?>
                        <tr>
                            <td><?php echo $all_del_rows['ar_dn_ref']; ?></td>
                            <td><?php echo $all_del_rows['ar_customer_name']; ?></td>
                            <td><?php echo $all_del_rows['ar_requested_by']; ?></td>
                            <td><?php echo $all_del_rows['ar_created_time']; ?></td>
                            <td>
                                <span class="status <?php if($all_del_rows['ar_status'] == 'pending'){echo 'pending';} else if($all_del_rows['ar_status'] == 'canceled'){echo 'process';}else if($all_del_rows['ar_status'] == 'delivered'){ echo 'completed';} ?>">
                                    <?php echo $all_del_rows['ar_status']; ?>
                                </span>
                            </td>
                            <td>
                                <form action="../DatabaseActions/statusUpdate.php" method="post" class="all_delss" style="display: flex;flex-direction: column;gap: 5px; align-items: center;<?php if($all_del_rows['ar_status'] != "pending" ){echo "display:none;" ;} else {echo "display:block;" ;} ?>" >
                                    <input class="form_data_status" type="hidden" name="id" value="<?php echo $all_del_rows['ar_id']; ?>">
                                    <select name="statusss"  class="form_data_status" style="padding:3px 6px ; font-size:12px;">
                                        <option value="pending">Pending</option>
                                        <option value="delivered">Delivered</option>
                                        <option value="canceled">Canceled</option>
                                    </select>
                                    <button type="submit" name="submited" class="submitteds" style="background:blue;color:#fff;font-size:12px;border:none;cursor:pointer;padding:2px 5px;border-radius:5px">Update</button>
                                </form>
                                <span style="<?php if($all_del_rows['ar_status'] != "pending" ){echo "display:block;" ;} else {echo "display:none;" ;} ?>"> <?php echo $all_del_rows['ar_status']; ?>  </span>
                            </td>
                            <td>
                                <form action="../DatabaseActions/inOut.php" method="post" style="display: flex;flex-direction: column;gap: 5px; align-items: center;<?php if($all_del_rows['ar_out_time'] != null ){echo "display:none;" ;} else {echo "display:block;" ;} ?>">
                                    <input type="hidden" name="id" value="<?php echo $all_del_rows['ar_id']; ?>">
                                    <input type="time" name="intime" style="padding:3px 6px ; font-size:12px;" value="<?php echo $all_del_rows['ar_out_time'] ?? date('H:i'); ?>">
                                    <button type="submit" name="issubmited" class="submitteds" style="background:blue;color:#fff;font-size:12px;border:none;cursor:pointer;padding:2px 5px;border-radius:5px">Update</button>
                                </form>
                                <span style="<?php if($all_del_rows['ar_out_time'] != "pending" ){echo "display:block;" ;} else {echo "display:none;" ;} ?>"> <?php echo $all_del_rows['ar_out_time']; ?>  </span>
                            </td>
                            <td>
                                <form action="../DatabaseActions/inOut.php" method="post" style="display: flex;flex-direction: column;gap: 5px; align-items: center;<?php if($all_del_rows['ar_in_time'] != null ){echo "display:none;" ;} else {echo "display:block;" ;} ?>">
                                    <input type="hidden" name="id" value="<?php echo $all_del_rows['ar_id']; ?>">
                                    <input type="time" name="outtime" style="padding:3px 6px ; font-size:12px;" value="<?php echo $all_del_rows['ar_in_time'] ?? date('H:i'); ?>" >
                                    <button type="submit" name="Outsubmited" class="submitteds" style="background:blue;color:#fff;font-size:12px;border:none;cursor:pointer;padding:2px 5px;border-radius:5px">Update</button>
                                </form>
                                <span style="<?php if($all_del_rows['ar_in_time'] != "pending" ){echo "display:block;" ;} else {echo "display:none;" ;} ?>"> <?php echo $all_del_rows['ar_in_time']; ?>  </span>
                            </td>
                            <td>
                                <form action="../DatabaseActions/inOut.php" method="post" style="display: flex;flex-direction: column;gap: 5px; align-items: center;<?php if($all_del_rows['ar_delivery_person'] != null ){echo "display:none;" ;} else {echo "display:block;" ;} ?>">
                                    <input type="hidden" name="id" value="<?php echo $all_del_rows['ar_id']; ?>">
                                    <input type="text" name="persons" style="padding:3px 6px ; font-size:12px;" value="<?php if($all_del_rows['ar_delivery_person'] != null) {echo $all_del_rows['ar_delivery_person'] ;} ?>" >
                                    <button type="submit" name="perdon" class="submitteds" style="background:blue;color:#fff;font-size:12px;border:none;cursor:pointer;padding:2px 5px;border-radius:5px">Update</button>
                                </form>
                                <span style="<?php if($all_del_rows['ar_delivery_person'] != null ){echo "display:block;" ;} else {echo "display:none;" ;}?>"> <?php echo "Mr. ".$all_del_rows['ar_delivery_person']; ?>  </span>
                            </td>
                            <td>
                                <form action="../DatabaseActions/DeleteDelivery.php" method="post">
                                    <input type="hidden" name="d_id" value="<?php echo $all_del_rows['ar_id']; ?>">
                                    <button type="submit" name="ddelete" class="submitteds" style="background:#D32F2F;color:#fff;font-size:14px;border:none;cursor:pointer;padding:4px 10px;border-radius:5px">Delete</button>
                                </form>
                            </td>
                        </tr>   
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

<script>
    // Function to filter table rows based on input value
    document.getElementById('filterInput').addEventListener('input', function() {
        var filterValue = this.value.toUpperCase();
        var rows = document.querySelectorAll('#deliveryTable tbody tr');

        rows.forEach(function(row) {
            var dn = row.cells[0].innerText.toUpperCase();
            if (dn.includes(filterValue)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
</script>





        <!--show all dliverys-->


        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>


<main id="all_Users_Delivery2"> 
    <div class="bottom-data">
        <div class="orders">
            <div class="header">
                <i class='bx bx-receipt'></i>
                <h3>All Users Created Deliveries</h3>
                <a href="./allDetail.php" id="" style="background-color: blue;font-size:20px;padding:10px 20px;color:#fff;border-radius: 5px;">See All Details</a>
                <i class='bx bx-filter'></i>
                <form id="filterForm2">
                    <input type="text" id="filterInput2" style="padding: 8px 15px;font-size:16px" placeholder="Filter">
                </form>
            </div>
            <table id="deliveryTable2">
                <thead>
                    <tr>
                        <th>DN</th>
                        <th>Customer Name</th>
                        <th>Contact Number</th>
                        <th>Contact Person</th>
                        <th>Urgency</th>
                        <th>Requested By</th>
                        <th>Created Time</th>
                        <th>Created Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($all_deliveries2_row = $all_delivery_smtp2->fetch(PDO::FETCH_ASSOC)){ ?>
                        <tr>
                            <td><?php echo $all_deliveries2_row['ar_dn_ref']; ?></td>
                            <td><?php echo $all_deliveries2_row['ar_customer_name']; ?></td>
                            <td><?php echo $all_deliveries2_row['ar_contact_number']; ?></td>
                            <td><?php echo $all_deliveries2_row['ar_contaced_person']; ?></td>
                            <td><?php echo $all_deliveries2_row['ar_urgancy']; ?></td>
                            <td><?php echo $all_deliveries2_row['ar_requested_by']; ?></td>
                            <td><?php echo $all_deliveries2_row['ar_created_time']; ?></td>
                            <td><?php echo $all_deliveries2_row['ar_created_date']; ?></td>
                            <td>
                                <span class="status <?php if($all_deliveries2_row['ar_status'] == 'pending'){echo 'pending';} else if($all_deliveries2_row['ar_status'] == 'canceled'){echo 'process';}else if($all_deliveries2_row['ar_status'] == 'delivered'){ echo 'completed';} ?>">
                                    <?php echo $all_deliveries2_row['ar_status']; ?>
                                </span>
                            </td>
                        </tr>   
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

<script>
    // Function to filter table rows based on input value
    document.getElementById('filterInput2').addEventListener('input', function() {
        var filterValue = this.value.toUpperCase();
        var rows = document.querySelectorAll('#deliveryTable2 tbody tr');

        rows.forEach(function(row) {
            var cells = row.cells;
            var found = false;
            for (var i = 0; i < cells.length; i++) {
                var cellText = cells[i].textContent.toUpperCase().trim();
                if (cellText.includes(filterValue)) {
                    found = true;
                    break;
                }
            }
            if (found) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });

    
</script>














        <!--quick analisis-->
        <main id="quick">
                <ul class="insights">
                    <li>
                        <i class='bx bx-calendar-check'></i>
                        <span class="info">
                            <h3>
                                <?php echo $all_users; ?>
                            </h3>
                            <p>Total Users</p>
                        </span>
                    </li>
                    <li><i class='bx bx-show-alt'></i>
                        <span class="info">
                            <h3>
                                <?php echo $all_deliveries; ?>
                            </h3>
                            <p>Total Created Delivery Arrangements</p>
                        </span>
                    </li>
                    <li ><i class='bx bx-line-chart'></i>
                        <span class="info">
                            <h3>
                                <?php echo $all_delivered_deliveries; ?>
                            </h3>
                            <p>Total Delivered Delivery Arrangements</p>
                        </span>
                    </li>  
                        <li >
                        <i class='bx bx-calendar-check'></i>
                        <span class="info">
                            <h3>
                                <?php echo $all_Pending_deliveries; ?>
                            </h3>
                            <p>Total Pending Delivery Arrangements</p>
                        </span>
                    </li>
                    <li ><i class='bx bx-show-alt'></i>
                        <span class="info">
                            <h3>
                                <?php echo $all_Canceled_deliveries; ?>
                            </h3>
                            <p>Total Canceled Delivery Arrangements</p>
                        </span>
                    </li>
                    <li>
                    <i class='bx bx-calendar-check'></i>
                        <span class="info">
                            <h3>
                                <?php echo $allreq_person; ?>
                            </h3>
                            <p>Total Users (REQUESTED BY)</p>
                        </span>
                    </li>
                    <li>
                        <i class='bx bx-calendar-check'></i>
                        <span class="info">
                            <h3>
                                <?php echo $allreq_person; ?>
                            </h3>
                            <p>Total Delivery Types</p>
                        </span>
                    </li>
                    </ul>
                    <br>
                    <div class="graphds">
                        <div style="width: 400px;height: 400px;text-align: center;">
                            <h1>Delivery Details</h1>
                            <canvas id="myChart"></canvas>
                        </div>
                        <div style="width: 400px;height: 400px;text-align: center;">
                            <h1>User Details</h1>
                            <canvas id="myChart2"></canvas>
                        </div>
                    </div>


                <script>
                const ctx = document.getElementById("myChart");

                    new Chart(ctx, {
                        type: "polarArea",
                        data: {
                        labels: ["Canceled Orders", "Delivred Orders", "Pending Orders" , "All Orders"],
                        datasets: [
                            {
                            label: "Deliveries",
                            data: [<?php echo $all_Canceled_deliveries; ?>, <?php echo $all_delivered_deliveries; ?>, <?php echo $all_Pending_deliveries; ?> , <?php echo $all_deliveries; ?>],
                            backgroundColor: [
                                "rgb(255, 99, 132)",
                                "rgb(75, 192, 192)",
                                "rgb(255, 205, 86)",
                                'rgb(54, 162, 235)'
                            ],
                            },
                        ],
                        },
                        options: {
                        scales: {
                            y: {
                            beginAtZero: true,
                            },
                        },
                        },
                    });




                    const ctx2 = document.getElementById("myChart2");

                    new Chart(ctx2, {
                        type: "polarArea",
                        data: {
                        labels: ["Web Developers", "Salse Persons", "Admin Users" ,"Accounting Users", "Admin Access Availabal Users" , "Admin Access Not Availabal Users" , "All Users"],
                        datasets: [
                            {
                            label: "Users",
                            data: [<?php echo $webdevelopercount; ?>, <?php echo $SalsePersondevelopercount; ?>, <?php echo $Admindevelopercount; ?>,<?php echo $accdevelopercount; ?> , <?php echo $Admin_Acc_Avalable; ?> ,  <?php echo $Admin_Acc_not ?> , <?php echo $all_users; ?>],
                            backgroundColor: [
                                "rgb(255, 99, 132)",
                                "rgb(75, 192, 192)",
                                "rgb(255, 205, 86)",
                                "rgb(113, 57, 176)",
                                "rgb(183, 67, 176)",
                                "rgb(70, 26, 180)",
                                'rgb(54, 162, 235)'
                            ],
                            },
                        ],
                        },
                        options: {
                        scales: {
                            y: {
                            beginAtZero: true,
                            },
                        },
                        },
                    });
                </script>

                

        </main>




        <!--all pending deliverys-->
<main id="all_pending"> 
    <div class="bottom-data">
        <div class="orders">
            <div class="header">
                <i class='bx bx-receipt'></i>
                <h3>All Pending Deliveries</h3>
                <i class='bx bx-filter'></i>
            </div>
            <table id="deliveryTable2">
                <thead>
                    <tr>
                        <th>DN</th>
                        <th>Customer Name</th>
                        <th>Contact Number</th>
                        <th>Contact Person</th>
                        <th>Urgency</th>
                        <th>Created By</th>
                        <th>Created Time</th>
                        <th>Created Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($all_delivery_sql_pending_row = $all_delivery_sql_pending->fetch(PDO::FETCH_ASSOC)){ ?>
                        <tr>
                            <td><?php echo $all_delivery_sql_pending_row['ar_dn_ref']; ?></td>
                            <td><?php echo $all_delivery_sql_pending_row['ar_customer_name']; ?></td>
                            <td><?php echo $all_delivery_sql_pending_row['ar_contact_number']; ?></td>
                            <td><?php echo $all_delivery_sql_pending_row['ar_contaced_person']; ?></td>
                            <td><?php echo $all_delivery_sql_pending_row['ar_urgancy']; ?></td>
                            <td><?php echo $all_delivery_sql_pending_row['ar_created_by']; ?></td>
                            <td><?php echo $all_delivery_sql_pending_row['ar_created_time']; ?></td>
                            <td><?php echo $all_delivery_sql_pending_row['ar_created_date']; ?></td>
                            <td>
                                <span class="status <?php if($all_delivery_sql_pending_row['ar_status'] == 'pending'){echo 'pending';} else if($all_delivery_sql_pending_row['ar_status'] == 'canceled'){echo 'process';}else if($all_delivery_sql_pending_row['ar_status'] == 'delivered'){ echo 'completed';} ?>">
                                    <?php echo $all_delivery_sql_pending_row['ar_status']; ?>
                                </span>
                            </td>
                        </tr>   
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

<!--for all canceled orders-->

<main id="all_canceled"> 
    <div class="bottom-data">
        <div class="orders">
            <div class="header">
                <i class='bx bx-receipt'></i>
                <h3>All Canceled Deliveries</h3>
                <i class='bx bx-filter'></i>
            </div>
            <table id="deliveryTable2">
                <thead>
                    <tr>
                        <th>DN</th>
                        <th>Customer Name</th>
                        <th>Contact Number</th>
                        <th>Contact Person</th>
                        <th>Urgency</th>
                        <th>Created By</th>
                        <th>Created Time</th>
                        <th>Created Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($all_canceled_sql_pending_row = $all_delivery_sql_canceled->fetch(PDO::FETCH_ASSOC)){ ?>
                        <tr>
                            <td><?php echo $all_canceled_sql_pending_row['ar_dn_ref']; ?></td>
                            <td><?php echo $all_canceled_sql_pending_row['ar_customer_name']; ?></td>
                            <td><?php echo $all_canceled_sql_pending_row['ar_contact_number']; ?></td>
                            <td><?php echo $all_canceled_sql_pending_row['ar_contaced_person']; ?></td>
                            <td><?php echo $all_canceled_sql_pending_row['ar_urgancy']; ?></td>
                            <td><?php echo $all_canceled_sql_pending_row['ar_created_by']; ?></td>
                            <td><?php echo $all_canceled_sql_pending_row['ar_created_time']; ?></td>
                            <td><?php echo $all_canceled_sql_pending_row['ar_created_date']; ?></td>
                            <td>
                                <span class="status <?php if($all_canceled_sql_pending_row['ar_status'] == 'pending'){echo 'pending';} else if($all_canceled_sql_pending_row['ar_status'] == 'canceled'){echo 'process';}else if($all_canceled_sql_pending_row['ar_status'] == 'delivered'){ echo 'completed';} ?>">
                                    <?php echo $all_canceled_sql_pending_row['ar_status']; ?>
                                </span>
                            </td>
                        </tr>   
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

<!--all delivered orders-->


<main id="all_delivered"> 
    <div class="bottom-data">
        <div class="orders">
            <div class="header">
                <i class='bx bx-receipt'></i>
                <h3>All Delivered Deliveries</h3>
                <i class='bx bx-filter'></i>
            </div>
            <table id="deliveryTable2">
                <thead>
                    <tr>
                        <th>DN</th>
                        <th>Customer Name</th>
                        <th>Contact Number</th>
                        <th>Contact Person</th>
                        <th>Urgency</th>
                        <th>Created By</th>
                        <th>Created Time</th>
                        <th>Created Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($all_delivery_sql_delivered_row = $all_delivery_sql_delivered->fetch(PDO::FETCH_ASSOC)){ ?>
                        <tr>
                            <td><?php echo $all_delivery_sql_delivered_row['ar_dn_ref']; ?></td>
                            <td><?php echo $all_delivery_sql_delivered_row['ar_customer_name']; ?></td>
                            <td><?php echo $all_delivery_sql_delivered_row['ar_contact_number']; ?></td>
                            <td><?php echo $all_delivery_sql_delivered_row['ar_contaced_person']; ?></td>
                            <td><?php echo $all_delivery_sql_delivered_row['ar_urgancy']; ?></td>
                            <td><?php echo $all_delivery_sql_delivered_row['ar_created_by']; ?></td>
                            <td><?php echo $all_delivery_sql_delivered_row['ar_created_time']; ?></td>
                            <td><?php echo $all_delivery_sql_delivered_row['ar_created_date']; ?></td>
                            <td>
                                <span class="status <?php if($all_delivery_sql_delivered_row['ar_status'] == 'pending'){echo 'pending';} else if($all_delivery_sql_delivered_row['ar_status'] == 'canceled'){echo 'process';}else if($all_delivery_sql_delivered_row['ar_status'] == 'delivered'){ echo 'completed';} ?>">
                                    <?php echo $all_delivery_sql_delivered_row['ar_status']; ?>
                                </span>
                            </td>
                        </tr>   
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

<!--alerts create -->

        <main id="alerts"> 
        
        <!-- Insights -->
        <ul class="insights">
                <li>
                    <i class='bx bx-calendar-check'></i>
                    <span class="info">
                        <h3>
                            <?php echo $user_name; ?>
                        </h3>
                        <p>Logged In As</p>
                    </span>
                </li>
                <li><i class='bx bx-line-chart'></i>
                    <span class="info">
                        <h3>
                            <?php echo $mail; ?>
                        </h3>
                        <p>My Mail</p>
                    </span>
            </li>
        </ul>
        <!-- End of Insights -->

        <!-- Insights -->
        <ul class="insights">
                <li>
                    <i class='bx bx-calendar-check'></i>
                    <span class="info">
                        <h3>
                            <?php echo $user_name; ?>
                        </h3>
                        <p>Total Created Notifications</p>
                    </span>
                </li>
                <li><i class='bx bx-line-chart'></i>
                    <span class="info">
                        <h3>
                            <?php echo $mail; ?>
                        </h3>
                        <p>Today Created Notifications</p>
                    </span>
            </li>
        </ul>



        <div class="bottom-data">
                <div class="reminders">
                    <div class="header">
                        <i class='bx bxs-bell-ring' ></i>
                        <h3>Notification Center</h3>
                        <i class='bx bx-plus' id="show-form2"></i>
                    </div>
                    <ul class="task-list">
                        <li class="completed">
                            <div class="task-title">
                                <i class='bx bx-check-circle'></i>
                                <p>Start Our Meeting</p>
                            </div>
                            <i class='bx bx-dots-vertical-rounded'></i>
                        </li>

                        <li class="completed">
                            <div class="task-title">
                                <i class='bx bx-check-circle'></i>
                                <p>Start Our Meeting</p>
                            </div>
                            <i class='bx bx-dots-vertical-rounded'></i>
                        </li>
                    </ul>
                </div>

            </div>
        </main>

            <!--add notification form-->
           <div class="popup-form2" style="position: absolute; margin-top: 50px; z-index: 1000;">
                    <div class="close-btn" id="close-form2">&times;</div>
                    <div class="form">
                        <h2>Create Notification</h2>
                        <form action="../DatabaseActions/Reminder.php" method="post">
                            <input type="hidden" name="n_created_user" value="<?php echo $_SESSION['user']; ?>">
                            <div class="form-element">
                                <label for="notification">Expected Date</label>
                                <input type="date" name="n_created_date" value="<?php echo date("Y-m-d"); ?>">
                            </div>
                            <div class="form-element">
                                <label for="notification">Your Notification</label>
                                <input type="text" name="notification" id="notification">
                            </div>
                            <div class="form-element">
                                <label for="notification_important">Importance</label>
                                <select name="notification_important" id="#">
                                    <option name="#" value="Important" id="#">Important</option>
                                    <option name="#" value="Not_Important" id="#">Not Important</option>
                                </select>
                            </div>
                            <div class="form-element">
                                <button type="submit" name="notification_submit">Add Reminder</button>
                            </div>
                        </form>
                    </div>
            </div> 


                <!--script for form-->

                <script>
                    document.querySelector("#show-form2").addEventListener("click" , function(){
                        document.querySelector(".popup-form2").classList.add("active")
                    });

                    document.querySelector("#close-form2").addEventListener("click" , function(){
                        document.querySelector(".popup-form2").classList.remove("active")
                    });
                </script>




    </div>
        <!--sweet alertd-->
        <?php
            if($_SESSION['userStarted'] == 1 && !$loginSuccessDisplayed ){
                echo '
                <script>
                Swal.fire({
                    title: "Login Sucessfull!",
                    text: "You are sucessfully loged In!",
                    icon: "success"
                  });
                  </script>
                '
                ;
                $_SESSION['loginSuccessDisplayed'] = true; // Set the flag to true
                $_SESSION['userStarted'] = null; // Reset the session variable
                
            }else if($_SESSION['inserted'] ==1  && !$dataInserted) {
                echo '
                <script>
                Swal.fire({
                    title: "Data Inserted Sucessfull!",
                    text: "You are sucessfully Inserted Data!",
                    icon: "success"
                  });
                  </script>
                '
                ;

                $_SESSION['inserted'] == null;
                $_SESSION['dataInserted'] = true; // Set the flag to true

            }else if($_SESSION['unInserted'] == 1) {
                echo '
                <script>
                Swal.fire({
					icon: "error",
					title: "Oops...",
					text: "Somethinng Went worng !",
				  });
                  </script>
                '
                ;
	            $_SESSION['unInserted'] = null;
            }else if($_SESSION['addUser'] ==1  && !$userInserted) {
                echo '
                <script>
                Swal.fire({
                    title: "User Inserted Sucessfull!",
                    text: "You are sucessfully Add User!",
                    icon: "success"
                  });
                  </script>
                '
                ;

                $_SESSION['addUser'] == null;
                $_SESSION['userInserted'] = true; // Set the flag to true

            }else if($_SESSION['user_deleted'] ==1  && !$dataDeleted) {
                echo '
                <script>
                Swal.fire({
                    title: "User Successfully Deleted!",
                    text: "You are sucessfully Delete User!",
                    icon: "success"
                  });
                  </script>
                '
                ;

                $_SESSION['user_deleted'] == null;
                $_SESSION['dataDeleted'] = true; // Set the flag to true

            }else if($_SESSION['status'] ==1  && !$dataStatus) {
                echo '
                <script>
                Swal.fire({
                    title: "Delivery Successfully Updated!",
                    text: "Delivery Sucessfully updated!",
                    icon: "success"
                  });
                  </script>
                '
                ;

                $_SESSION['status'] == null;
                $_SESSION['dataStatus'] = true; // Set the flag to true

            }else if($_SESSION['time'] ==1  && !$dataTime) {
                echo '
                <script>
                Swal.fire({
                    title: "Time Successfully Updated!",
                    text: "Time Sucessfully updated!",
                    icon: "success"
                  });
                  </script>
                '
                ;
                
                $_SESSION['time'] == null;
                $_SESSION['dataTime'] = true;
                 // Set the flag to true

            }else if($_SESSION['remind_delete'] ==1  && !$RemindDelete) {
                echo '
                <script>
                Swal.fire({
                    title: "Reminder Deleted!",
                    text: "Reminder Sucessfully Deleted!",
                    icon: "success"
                  });
                  </script>
                '
                ;

                $_SESSION['remind_delete'] == null;
                $_SESSION['RemindDelete'] = true; // Set the flag to true

            }else if($_SESSION['Delete_deliery'] ==1  && !$Deletedeliery) {
                echo '
                <script>
                Swal.fire({
                    title: "Delivery Deleted!",
                    text: "Delivery Sucessfully Deleted!",
                    icon: "success"
                  });
                  </script>
                '
                ;

                $_SESSION['Delete_deliery'] == null;
                $_SESSION['Deletedeliery'] = true; // Set the flag to true

            }
        ?>

    <!---->
    <script>
        function displyforms(){
            document.getElementById("forms").style.display = "block";
            document.getElementById("dashbord").style.display = "none";
            document.getElementById("all_Users_Delivery").style.display = "none";
            document.getElementById("allDelivery").style.display = "none";
            document.getElementById("Adduser_form").style.display = "none";
            document.getElementById("quick").style.display = "none";
            document.getElementById("all_Users_Delivery2").style.display = "none";
            document.getElementById("all_pending").style.display = "none";
            document.getElementById("all_canceled").style.display= "none";
            document.getElementById("all_delivered").style.display = "none";
            document.getElementById("req_person").style.display = "none";
            document.getElementById("delivery_type").style.display = "none";
            document.getElementById("alerts").style.display = "none";
        }

        function displayash(){
            document.getElementById("forms").style.display = "none";
            document.getElementById("dashbord").style.display = "block";
            document.getElementById("allDelivery").style.display = "none";
            document.getElementById("Adduser_form").style.display = "none";
            document.getElementById("allusers").style.display = "none";
            document.getElementById("all_Users_Delivery").style.display = "none";
            document.getElementById("quick").style.display = "none";
            document.getElementById("all_Users_Delivery2").style.display = "none";
            document.getElementById("all_pending").style.display = "none";
            document.getElementById("all_canceled").style.display= "none";
            document.getElementById("all_delivered").style.display = "none";
            document.getElementById("req_person").style.display = "none";
            document.getElementById("delivery_type").style.display = "none";
            document.getElementById("alerts").style.display = "none";
        }

        function displayalldel(){
            document.getElementById("allDelivery").style.display = "block";
            document.getElementById("forms").style.display = "none";
            document.getElementById("dashbord").style.display = "none";
            document.getElementById("Adduser_form").style.display = "none";
            document.getElementById("allusers").style.display = "none";
            document.getElementById("all_Users_Delivery").style.display = "none";
            document.getElementById("quick").style.display = "none";
            document.getElementById("all_Users_Delivery2").style.display = "none";
            document.getElementById("all_pending").style.display = "none";
            document.getElementById("all_canceled").style.display= "none";
            document.getElementById("all_delivered").style.display = "none";
            document.getElementById("req_person").style.display = "none";
            document.getElementById("delivery_type").style.display = "none";
            document.getElementById("alerts").style.display = "none";
        }

        function displayAddUser(){
            document.getElementById("Adduser_form").style.display = "block";
            document.getElementById("allDelivery").style.display = "none";
            document.getElementById("forms").style.display = "none";
            document.getElementById("dashbord").style.display = "none";
            document.getElementById("allusers").style.display = "none";
            document.getElementById("all_Users_Delivery").style.display = "none";
            document.getElementById("quick").style.display = "none";
            document.getElementById("all_Users_Delivery2").style.display = "none";
            document.getElementById("all_pending").style.display = "none";
            document.getElementById("all_canceled").style.display= "none";
            document.getElementById("all_delivered").style.display = "none";
            document.getElementById("req_person").style.display = "none";
            document.getElementById("delivery_type").style.display = "none";
            document.getElementById("alerts").style.display = "none";
        }

        function displayAllusers(){
            document.getElementById("allusers").style.display = "block";
            document.getElementById("Adduser_form").style.display = "none";
            document.getElementById("allDelivery").style.display = "none";
            document.getElementById("forms").style.display = "none";
            document.getElementById("dashbord").style.display = "none";
            document.getElementById("all_Users_Delivery").style.display = "none";
            document.getElementById("quick").style.display = "none";
            document.getElementById("all_Users_Delivery2").style.display = "none";
            document.getElementById("all_pending").style.display = "none";
            document.getElementById("all_canceled").style.display= "none";
            document.getElementById("all_delivered").style.display = "none";
            document.getElementById("req_person").style.display = "none";
            document.getElementById("delivery_type").style.display = "none";
            document.getElementById("alerts").style.display = "none";
          
        }

        function diaplayAllUserDelivery(){
            document.getElementById("all_Users_Delivery").style.display = "block";
            document.getElementById("allusers").style.display = "none";
            document.getElementById("Adduser_form").style.display = "none";
            document.getElementById("allDelivery").style.display = "none";
            document.getElementById("forms").style.display = "none";
            document.getElementById("dashbord").style.display = "none";
            document.getElementById("quick").style.display = "none";
            document.getElementById("all_Users_Delivery2").style.display = "none";
            document.getElementById("all_pending").style.display = "none";
            document.getElementById("all_canceled").style.display= "none";
            document.getElementById("all_delivered").style.display = "none";
            document.getElementById("req_person").style.display = "none";
            document.getElementById("delivery_type").style.display = "none";
            document.getElementById("alerts").style.display = "none";
        }

        function quickAna(){
            document.getElementById("quick").style.display = "block";
            document.getElementById("all_Users_Delivery").style.display = "none";
            document.getElementById("allusers").style.display = "none";
            document.getElementById("Adduser_form").style.display = "none";
            document.getElementById("allDelivery").style.display = "none";
            document.getElementById("forms").style.display = "none";
            document.getElementById("dashbord").style.display = "none";
            document.getElementById("all_Users_Delivery2").style.display = "none";
            document.getElementById("all_pending").style.display = "none";
            document.getElementById("all_canceled").style.display= "none";
            document.getElementById("all_delivered").style.display = "none";
            document.getElementById("req_person").style.display = "none";
            document.getElementById("delivery_type").style.display = "none";
            document.getElementById("alerts").style.display = "none";
        }

        function diaplayAllUserDelivery2(){
            document.getElementById("all_Users_Delivery2").style.display = "block";
            document.getElementById("all_Users_Delivery").style.display = "none";
            document.getElementById("allusers").style.display = "none";
            document.getElementById("Adduser_form").style.display = "none";
            document.getElementById("allDelivery").style.display = "none";
            document.getElementById("forms").style.display = "none";
            document.getElementById("dashbord").style.display = "none";
            document.getElementById("quick").style.display = "none";
            document.getElementById("all_pending").style.display = "none";
            document.getElementById("all_canceled").style.display= "none";
            document.getElementById("all_delivered").style.display = "none";
            document.getElementById("req_person").style.display = "none";
            document.getElementById("delivery_type").style.display = "none";
            document.getElementById("alerts").style.display = "none";
        }

        function displayAllPending(){
            //all_pending
            document.getElementById("all_pending").style.display = "block";
            document.getElementById("all_Users_Delivery2").style.display = "none";
            document.getElementById("all_Users_Delivery").style.display = "none";
            document.getElementById("allusers").style.display = "none";
            document.getElementById("Adduser_form").style.display = "none";
            document.getElementById("allDelivery").style.display = "none";
            document.getElementById("forms").style.display = "none";
            document.getElementById("dashbord").style.display = "none";
            document.getElementById("quick").style.display = "none";
            document.getElementById("all_canceled").style.display= "none";
            document.getElementById("all_delivered").style.display = "none";
            document.getElementById("req_person").style.display = "none";
            document.getElementById("delivery_type").style.display = "none";
            document.getElementById("alerts").style.display = "none";
        }

        function displayAllCanceled(){
            //all_canceled
            document.getElementById("all_pending").style.display = "none";
            document.getElementById("all_Users_Delivery2").style.display = "none";
            document.getElementById("all_Users_Delivery").style.display = "none";
            document.getElementById("allusers").style.display = "none";
            document.getElementById("Adduser_form").style.display = "none";
            document.getElementById("allDelivery").style.display = "none";
            document.getElementById("forms").style.display = "none";
            document.getElementById("dashbord").style.display = "none";
            document.getElementById("quick").style.display = "none";
            document.getElementById("all_canceled").style.display= "block";
            document.getElementById("all_delivered").style.display = "none";
            document.getElementById("req_person").style.display = "none";
            document.getElementById("delivery_type").style.display = "none";
            document.getElementById("alerts").style.display = "none";
        }

        function displayDelivered(){
            document.getElementById("all_pending").style.display = "none";
            document.getElementById("all_Users_Delivery2").style.display = "none";
            document.getElementById("all_Users_Delivery").style.display = "none";
            document.getElementById("allusers").style.display = "none";
            document.getElementById("Adduser_form").style.display = "none";
            document.getElementById("allDelivery").style.display = "none";
            document.getElementById("forms").style.display = "none";
            document.getElementById("dashbord").style.display = "none";
            document.getElementById("quick").style.display = "none";
            document.getElementById("all_canceled").style.display= "none";
            document.getElementById("all_delivered").style.display = "block";
            document.getElementById("req_person").style.display = "none";
            document.getElementById("delivery_type").style.display = "none";
            document.getElementById("alerts").style.display = "none";
        }

        function displayAddReqPerosn() {
            document.getElementById("req_person").style.display = "block";
            document.getElementById("all_pending").style.display = "none";
            document.getElementById("all_Users_Delivery2").style.display = "none";
            document.getElementById("all_Users_Delivery").style.display = "none";
            document.getElementById("allusers").style.display = "none";
            document.getElementById("Adduser_form").style.display = "none";
            document.getElementById("allDelivery").style.display = "none";
            document.getElementById("forms").style.display = "none";
            document.getElementById("dashbord").style.display = "none";
            document.getElementById("quick").style.display = "none";
            document.getElementById("all_canceled").style.display= "none";
            document.getElementById("all_delivered").style.display = "none";
            document.getElementById("delivery_type").style.display = "none";
            document.getElementById("alerts").style.display = "none";
        }

        function createDeliveryType(){
            document.getElementById("delivery_type").style.display = "block";
            document.getElementById("req_person").style.display = "none";
            document.getElementById("all_pending").style.display = "none";
            document.getElementById("all_Users_Delivery2").style.display = "none";
            document.getElementById("all_Users_Delivery").style.display = "none";
            document.getElementById("allusers").style.display = "none";
            document.getElementById("Adduser_form").style.display = "none";
            document.getElementById("allDelivery").style.display = "none";
            document.getElementById("forms").style.display = "none";
            document.getElementById("dashbord").style.display = "none";
            document.getElementById("quick").style.display = "none";
            document.getElementById("all_canceled").style.display= "none";
            document.getElementById("all_delivered").style.display = "none";
            document.getElementById("alerts").style.display = "none";
        }

        function displaycreatealert(){
            document.getElementById("alerts").style.display = "block";
            document.getElementById("delivery_type").style.display = "none";
            document.getElementById("req_person").style.display = "none";
            document.getElementById("all_pending").style.display = "none";
            document.getElementById("all_Users_Delivery2").style.display = "none";
            document.getElementById("all_Users_Delivery").style.display = "none";
            document.getElementById("allusers").style.display = "none";
            document.getElementById("Adduser_form").style.display = "none";
            document.getElementById("allDelivery").style.display = "none";
            document.getElementById("forms").style.display = "none";
            document.getElementById("dashbord").style.display = "none";
            document.getElementById("quick").style.display = "none";
            document.getElementById("all_canceled").style.display= "none";
            document.getElementById("all_delivered").style.display = "none";
        }



        function logoutfunction(){
            Swal.fire({
                title: "Are you sure?",
                text: "Do you want to LogOut ??!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Logout Now!"
                }).then((result) => {
                if (result.isConfirmed) {
                    location.href="../DatabaseActions/logout.php" 
                }
                });

        }
    </script>
    <script src="index.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>

</html>
































