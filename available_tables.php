<!DOCTYPE html>
<?php
    session_start();
    require('database.php');
?>
<head>
        <title>
            Available Tables
        </title>
        <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
        <script type="text/javascript"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet"
              href= "https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z"
              crossorigin="anonymous" />
        <meta name=”viewport” content=”width=device-width, initial-scale=1″>
    </head>

    <body>
    <?php
    $sql = $_SESSION['myquery'];
    $reservation_from = $_SESSION['reservation_from'];
    $reservation_to = $_SESSION['reservation_to'];
    $cust_id=$_SESSION['cust_id'];
    $reservation_from_timestamp = strtotime($reservation_from); 
    $reservation_from_date_object = getDate($reservation_from_timestamp); 
    $reservation_to_timestamp = strtotime($reservation_to); 
    $reservation_to_date_object = getDate($reservation_to_timestamp);
    $query2 = mysqli_query($database_connection,$sql);   
    $count=mysqli_num_rows($query2);
    if($count!=0){       
    echo '
    <br><br>
    <h1>Choose your Table</h1>
    <table class="table custom-table" style="position: relative;  position: relative; top: 50px;"'; 
    echo '
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/TSs/bootstrap.min.TSs" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <tr> 
    <thead class="thead-dark">
    <th  scope="col"> <font face="Arial">Branch</font> </th> 
    <th  scope="col"> <font face="Arial">Category</font> </th> 
    <th  scope="col"> <font face="Arial">Number of Seats</font> </th> 
    <th  scope="col"> <font face="Arial">Hourly rate</font> </th>
    <th  scope="col"> <font face="Arial">Reserve</font> </th>

    </thead>
    </tr>
    ';
    $i=0;
    while($row = mysqli_fetch_assoc($query2))          
    {
        $field1name = $row["location"];
        $field2name = $row["category"];
        $field3name = $row["number_of_seats"];
        $field4name = $row["price_per_hour"];

        echo '<tr> 
            <td class="row-data">'  .$field1name.'</td> 
            <td class="row-data">'  .$field2name.'</td> 
            <td>'  .$field3name.'</td> 
            <td>'  .$field4name.'</td>';
            echo "<td>" . '<form type="POST"><input type="hidden" name="id" value='.$row['table_id'].'><input type="submit" name="reserve_btn" value="Reserve"></form>' . "</td>";
            echo "</tr>";
    }
    echo '</table>';
}
else{
    echo' <div style="position: relative; top: 100;">
            <h2 style="position: relative; left: 10px;"> No tables available for the specified criteria </h2>
            </div>';
}
if(isset($_REQUEST['reserve_btn']))
{
    $table_id=$_REQUEST['id'];
    $sql_table_state = "SELECT TS.`from`,TS.`to`
            FROM  TABLE_STATUS AS TS 
            WHERE TS.table_id = '".$table_id."' AND TS.state = 'Available' AND '".$reservation_from."' >= TS.`from` AND ('" .$reservation_to. "' <= TS.`to` OR TS.`to` IS NULL )";
    $query = mysqli_query($database_connection,$sql_table_state);
    $my_row = mysqli_fetch_assoc($query);
    $AF1=$my_row["from"];
    $AT1=$my_row["to"];
    $date1 = strtotime($AF1); 
    $AF = getDate($date1); 
    $date2 = strtotime($AT1); 
    $AT = getDate($date2);
    if($AF == $reservation_from_date_object and $AT == $reservation_to_date_object){
    $q1="UPDATE TABLE_STATUS AS TS SET TS.state= 'Not Available' WHERE TS.table_id= '".$table_id."' AND state='Available' AND TS.`from`='".$AF1."'";
    mysqli_query($database_connection,$q1);
    }
    elseif($AF == $reservation_from_date_object){
        $q1="DELETE FROM TABLE_STATUS WHERE table_id='".$table_id."' AND `from`='".$AF1."' AND state='Available'";
        $q2="INSERT INTO TABLE_STATUS (table_id, state, `from`, `to`) values ('".$table_id."', 'Not Available', '".$reservation_from."', '".$reservation_to."')";
        if(is_null($AT1)){
            $q3="INSERT INTO TABLE_STATUS (table_id, state, `from`, `to`) values ('".$table_id."', 'Available',DATE_ADD('".$reservation_to."', INTERVAL +1 SECOND),NULL)";
        }
        else $q3="INSERT INTO TABLE_STATUS (table_id, state, `from`, `to`) values ('".$table_id."', 'Available',DATE_ADD('".$reservation_to."', INTERVAL +1 SECOND),'".$AT1."')";
        mysqli_query($database_connection,$q1);
        mysqli_query($database_connection,$q2);
        mysqli_query($database_connection,$q3);
    }        
    elseif ($AT == $reservation_to_date_object){
        $q1="UPDATE TABLE_STATUS AS TS SET TS.`to`=DATE_ADD('".$reservation_from."', INTERVAL -1 SECOND) WHERE TS.table_id='".$table_id."' AND TS.`from`='".$AF1."' AND TS.state='Available'";
        $q2="INSERT INTO TABLE_STATUS (table_id, state, `from`, `to`) values ('".$table_id."', 'Not Available', '".$reservation_from."', '".$reservation_to."')";
        mysqli_query($database_connection,$q1);
        mysqli_query($database_connection,$q2);

    } 
    else
    {
        $q1="UPDATE TABLE_STATUS AS TS SET TS.`to`=DATE_ADD('".$reservation_from."', INTERVAL -1 SECOND) WHERE TS.table_id='".$table_id."' AND TS.`from`='".$AF1."' AND TS.state='Available'";
        $q2="INSERT INTO TABLE_STATUS (table_id, state, `from`, `to`) values ('".$table_id."', 'Not Available', '".$reservation_from."', '".$reservation_to."')";
        if(is_null($AT1)){
            $q3="INSERT INTO TABLE_STATUS (table_id, state, `from`, `to`) values ('".$table_id."', 'Available',DATE_ADD('".$reservation_to."', INTERVAL +1 SECOND), NULL)";
        }
        else {
        $q3="INSERT INTO TABLE_STATUS (table_id, state, `from`, `to`) values ('".$table_id."', 'Available',DATE_ADD('".$reservation_to."', INTERVAL +1 SECOND), '".$AT1."')";
        }
        mysqli_query($database_connection,$q1);
        mysqli_query($database_connection,$q2);
        mysqli_query($database_connection,$q3);
    }
    $sql_table_info = "SELECT T.category,T.number_of_seats,T.price_per_hour,T.branch_id,B.location
            FROM  `TABLE` AS T NATURAL JOIN BRANCH AS B
            WHERE T.table_id = '".$table_id."'";
    $query = mysqli_query($database_connection,$sql_table_info);
    $table_row = mysqli_fetch_assoc($query);
    $hour_diff = ceil((abs($reservation_from_timestamp-$reservation_to_timestamp)/(60*60)));
    $t_category=$table_row["category"];
    $t_number_of_seats=$table_row["number_of_seats"];
    $t_price_per_hour=$table_row["price_per_hour"];
    $t_location=$table_row["location"];
    $B_id=$table_row["branch_id"];
    $_SESSION['branch_id']=$B_id;
    $_SESSION['cust_id']=$cust_id;
    $_SESSION['t_id']=$table_id;
    $_SESSION['t_category']=$t_category;
    $_SESSION['t_number_of_seats']=$t_number_of_seats;
    $_SESSION['t_price_per_hour']=$t_price_per_hour;
    $_SESSION['t_location']=$t_location;
    $_SESSION['hour_diff']= $hour_diff;
    $_SESSION['reservation_to']= $reservation_to;
    $_SESSION['reservation_from']= $reservation_from;
    $_SESSION['cost']=$hour_diff*$t_price_per_hour;
    $_SESSION['available_from']=$AF1;
    $_SESSION['available_to']=$AT1;
    header("Location: payment.php");
}
?>
      
</html>


