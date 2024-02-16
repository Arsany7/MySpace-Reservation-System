<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8"/>
    <title>Payment Confirmation</title>
    <link href="stylefile.css" rel="stylesheet" type="text/css"/>
</head>
<?php
    session_start();
    require('database.php');
?>
<?php
$B_id=$_SESSION['branch_id'];
$cust_id=$_SESSION['cust_id'];
$table_id=$_SESSION['t_id'];
$t_category=$_SESSION['t_category'];
$t_number_of_seats=$_SESSION['t_number_of_seats'];
$t_price_per_hour=$_SESSION['t_price_per_hour'];
$t_location=$_SESSION['t_location'];
$hour_diff=$_SESSION['hour_diff'];
$reservation_to=$_SESSION['reservation_to'];
$reservation_from=$_SESSION['reservation_from'];
$cost=$_SESSION['cost'];
$AF1=$_SESSION['available_from'];
$AT1=$_SESSION['available_to'];

if(isset($_POST['pay'])){
    $q1="INSERT INTO RESERVATION (cust_id, table_id, `from`, `to`, cost, reserved_hours) values ('".$cust_id."', '".$table_id."','".$reservation_from."','".$reservation_to."','".$cost."','".$hour_diff."')";
    $q2="UPDATE TABLE_STATUS SET `state` = 'Reserved' where table_id = '".$table_id."' AND `state`='Not Available' AND `from`='".$reservation_from."'";
$q3="Select fname from customer where cust_id='".$cust_id."'";
mysqli_query($database_connection,$q1);
mysqli_query($database_connection,$q2);
$row=mysqli_query($database_connection,$q3);
$rowfname = mysqli_fetch_assoc($row);
$_SESSION['id']= $cust_id;
$_SESSION['fname']= $rowfname["fname"];
$_SESSION['reservation_confirmation'] = "Your reservation is confirmed!";
header("Location: customer_start.php");
}
else if (isset($_POST['cancel'])){
    $AF1=$_SESSION['available_from'];
    $AT1=$_SESSION['available_to'];
    if (is_null($AT1)){
        $q1="DELETE FROM TABLE_STATUS WHERE `from` >= '".$AF1."' AND table_id='".$table_id."'";
        $q2="INSERT INTO TABLE_STATUS (table_id, `state`, `from`, `to`) values ('".$table_id."', 'Available','".$AF1."', NULL)";
    }
    else{
        $q1="DELETE FROM TABLE_STATUS WHERE `from` >= '".$AF1."' AND (`to` <= '".$AT1."' )AND table_id='".$table_id."'";
        $q2="INSERT INTO TABLE_STATUS (table_id, `state`, `from`, `to`) values ('".$table_id."', 'Available','".$AF1."','".$AT1."')";
    }
    $q3="Select fname from customer where cust_id='".$cust_id."'";
    mysqli_query($database_connection,$q1);
    mysqli_query($database_connection,$q2);
    $row=mysqli_query($database_connection,$q3);
    $rowfname = mysqli_fetch_assoc($row);
    $_SESSION['id']= $cust_id;
    $_SESSION['fname']= $rowfname["fname"];
    $_SESSION['reservation_confirmation'] = "No Reservation has been made!";
    header("Location: customer_start.php");
}
?>
<form class="form" name="Payment" method="post" action="#">
        <h1 class="login-title">Payment Confirmation</h1>
        <h2>Table Category: <?php echo $t_category  ?></h2><br>
        <h2>Table Number of Seats: <?php echo $t_number_of_seats  ?></h2><br>
        <h2>Hourly rate: <?php echo $t_price_per_hour  ?></h2><br>
        <h2>Reservation durations: <?php echo $hour_diff ?></h2><br>
        <h2>Total cost: <?php echo $cost  ?></h2><br>
        <h2>Branch Location: <?php echo $t_location  ?></h2><br>
        <input type="submit" name="pay" value="Confirm Payment" class="login-button"><br>
        <input type="submit" name="cancel" value="Cancel Reservation" class="login-button">
    </form>
</html>    