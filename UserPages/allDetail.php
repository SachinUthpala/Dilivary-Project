<?php
session_start();
require_once("../DatabaseActions/Connection.php");
date_default_timezone_set('Asia/Colombo');

//all deliverys
$all_delivery_sql2 = "SELECT * FROM Delivery_arraange ORDER BY ar_id DESC";
$all_delivery_smtp2 = $conn -> prepare($all_delivery_sql2);
$all_delivery_smtp2->execute();
$all_deliveries2 = $all_delivery_smtp2->rowCount();

// Check if user is logged in and userSet session variable is set
if (!isset($_SESSION['user'])){
    header("Location: ../index.php");
    exit; // Exit to prevent further execution
}
$user = $_SESSION["user"];  

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>East Link</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            text-decoration: none;
        }

        .table-container {
            overflow-x: auto;
            margin: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        .status {
            padding: 3px 5px;
            border-radius: 5px;
            color: #fff;
        }

        .status.completed {
            background: #388E3C;
        }

        .status.process {
            background: rgb(255, 31, 117);
        }

        .status.pending {
            background: #FBC02D;
        }

        /* Adjust styles for smaller screens */
        @media screen and (max-width: 600px) {
            table {
                border: 0;
            }

            table thead {
                display: none;
            }

            table tbody {
                display: block;
            }

            table tbody tr {
                display: block;
                margin-bottom: 20px;
                border: 1px solid #ddd;
            }

            table tbody tr:nth-child(even) {
                background-color: #f2f2f2;
            }

            table tbody tr td {
                display: block;
                text-align: left;
                border: none;
            }

            table tbody tr td:before {
                content: attr(data-label);
                font-weight: bold;
                float: left;
                width: 50%;
            }
        }

    </style>
</head>
<body>
<br><br><br>
<a href="./UserPage.php" id="" style="background-color: blue;font-size:20px;padding:10px 20px;color:#fff;border-radius: 5px;margin-top:40px;margin-left:20px;text-decoration: none;" >Go Back</a>
<br><br>
<div class="table-container">
    <input type="text" id="searchInput" placeholder="Search..." style="padding:10px 20px;font-size:18px;margin-bottom: 20px;border-radius: 5px; "><br>
    <table id="dataTable">
        <thead>
        <tr>
            <th>DN REF</th>
            <th>CUSTOMER</th>
            <th>DEL ADDRESS</th>
            <th>CONTACT PERSON</th>
            <th>CONTACT NUMBER</th>
            <th>REQUESTED BY</th>
            <th>CREATED BY</th>
            <th>CREATED DATE</th>
            <th>CREATED TIME</th>
            <th>DELIVERY PERSON</th>
            <th>DELIVERY TYPE</th>
            <th>VEHICLE</th>
            <th>EXPECTED DELIVERY DATE</th>
            <th>OUT TIME</th>
            <th>IN TIME</th>
            <th>STATUS</th>
        </tr>
        </thead>
        <tbody>
        <?php while($all_deliveries2_row = $all_delivery_smtp2->fetch(PDO::FETCH_ASSOC)){ ?>
        <tr>
            <td><?php echo $all_deliveries2_row['ar_dn_ref']; ?></td>
            <td><?php echo $all_deliveries2_row['ar_customer_name']; ?></td>
            <td><?php echo $all_deliveries2_row['ar_delivery_address']; ?></td>
            <td><?php echo $all_deliveries2_row['ar_contaced_person']; ?></td>
            <td><?php echo $all_deliveries2_row['ar_contact_number']; ?></td>
            <td><?php echo $all_deliveries2_row['ar_requested_by']; ?></td>
            <td><?php echo $all_deliveries2_row['ar_created_by']; ?></td>
            <td><?php echo $all_deliveries2_row['ar_created_date']; ?></td>
            <td><?php echo $all_deliveries2_row['ar_created_time']; ?></td>
            <td><?php echo $all_deliveries2_row['ar_delivery_person']; ?></td>
            <td><?php echo $all_deliveries2_row['ar_type_of_delivery']; ?></td>
            <td><?php echo $all_deliveries2_row['ar_vehicle_type']; ?></td>
            <td><?php echo $all_deliveries2_row['exp_del_date']; ?></td>
            <td><?php echo $all_deliveries2_row['ar_out_time']; ?></td>
            <td><?php echo $all_deliveries2_row['ar_in_time']; ?></td>
            <td>
                <span class="status <?php if($all_deliveries2_row['ar_status'] == 'pending'){echo 'pending';} else if($all_deliveries2_row['ar_status'] == 'canceled'){echo 'process';}else if($all_deliveries2_row['ar_status'] == 'delivered'){ echo 'completed';} ?>">
                    <?php echo $all_deliveries2_row['ar_status']; ?>
                </span>
            </td>
        </tr>
        <?php }?>
        </tbody>
    </table>
    <br>
    <div class="pagination" style="margin-right:10px;"></div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        var dataTable = document.getElementById("dataTable");
        var pagination = document.querySelector(".pagination");
        var rows = dataTable.tBodies[0].rows;
        var rowsPerPage = 15;
        var pageCount = Math.ceil(rows.length / rowsPerPage);

        function displayRows(page) {
            var start = (page - 1) * rowsPerPage;
            var end = start + rowsPerPage;
            for (var i = 0; i < rows.length; i++) {
                rows[i].style.display = i >= start && i < end ? "" : "none";
            }
        }

        function createPagination() {
            pagination.innerHTML = "";
            for (var i = 1; i <= pageCount; i++) {
                var button = document.createElement("button");
                button.textContent = i;
                button.addEventListener("click", function () {
                    var page = parseInt(this.textContent);
                    displayRows(page);
                });
                pagination.appendChild(button);
            }
        }

        displayRows(1);
        createPagination();

        // Add event listener to the search input
        document.getElementById('searchInput').addEventListener('input', function () {
            var searchText = this.value.toLowerCase();
            for (var i = 0; i < rows.length; i++) {
                var row = rows[i];
                var rowData = row.textContent.toLowerCase();
                if (rowData.includes(searchText)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            }
        });
    });

</script>

</body>
</
