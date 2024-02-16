<!DOCTYPE html>
<?php
    session_start();
    require('database.php');
?>
<html>
    <head>
        <title>
            Customer Page
        </title>
        <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
        <script type="text/javascript"></script>
        <link href="stylefile.css" rel="stylesheet" type="text/css"/>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>
    <style>
        h1 {
    font-weight: bold; 
    position: relative; 
    bottom: 70px; 
    color:#ffffff ;
}
#leftDIV {
                float:left; 
                width:50%;
                height:280px;
            }
            #rightDIV{
                float:left;
                width:50%;
                height:280px;
            }
        </style>
        

    <body>
        <br><br><br>
    <div id = "leftDIV" style="position: relative; top: 0;">
        <h1 style="position: relposition:relative; top:-50px">Welcome <?php echo $_SESSION['fname'];?>  !</h1><br>
        <h1 style="position: relative;"><?php echo $_SESSION['reservation_confirmation'];?></h1>
    <?php
        $customer_id=$_SESSION['id'];
        $query2 = mysqli_query($database_connection,"select * from reservation where cust_id='$customer_id'");
        $count=mysqli_num_rows($query2);
        if($count!=0){
            echo '
            <p style="font-size:30px; position:relative; color:#ffffff ; top:-40px;left:20px; font-weight:bold;">Your Reservations<p>
            <table class="table custom-table" style="position:  max-width: 500px;relative; left: 10px; position: relative; top: 10px;"'; 
            echo '
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
            <tr> 
            <thead class="thead-dark">   
              <th> <font face="Arial">Table ID</font> </th> 
              <th> <font face="Arial">Reserved from</font> </th> 
              <th> <font face="Arial">Reserved to</font> </th> 
              <th> <font face="Arial">Cost</font> </th> 
              <th> <font face="Arial">Reserved hours</font> </th> 
            </thead>   
            </tr>
            ';
        while($row = mysqli_fetch_assoc($query2)){
            $field1name = $row["table_id"];
            $field2name = $row["from"];
            $field3name = $row["to"];
            $field4name = $row["cost"];
            $field5name = $row["reserved_hours"]; 
            echo '<tr> 
                  <td>'  .$field1name.'</td> 
                  <td>'  .$field2name.'</td> 
                  <td>'  .$field3name.'</td> 
                  <td>'  .$field4name.'</td> 
                  <td>'  .$field5name.'</td> 
                </tr>';
        }
        echo '</table>';
    }
    else 
         {
           echo' <div style="position: relative;font-color:red;">
            <h2 style="position: relative; left: 0px;"> No Reserved Tables yet </h2>
            </div>
            <br><br><br><br><br><br><br><br><br><br><br><br><br>
            ';


         }   
        ?>
        <?php
         if(isset($_POST['submit'])){
            $reservation_date=$_POST['reservation_date']; 
            $reservation_hour_from=$_POST['reservation_hour_from'];
            $reservation_from_datetime = $reservation_date . ' ' . $reservation_hour_from . ':00:00';
            $reservation_hour_to=$_POST['reservation_hour_to'];
            $reservation_hour_to = str_pad(max(intval($reservation_hour_to) - 1, 0), 2, '0', STR_PAD_LEFT);
            $reservation_to_datetime = $reservation_date . ' ' . $reservation_hour_to . ':59:59';

            $sql = "SELECT T.table_id,T.category,T.number_of_seats,T.price_per_hour,B.location,TS.`from`,TS.`to`
            FROM `TABLE` AS T NATURAL JOIN TABLE_STATUS AS TS NATURAL JOIN BRANCH AS B
            WHERE TS.state = 'Available' AND '".$reservation_from_datetime."' >= TS.`from` AND ('" .$reservation_to_datetime. "' <= TS.`to` OR TS.`to` IS NULL )";

            if(!empty($_POST['branch'])){
                $branch=$_POST['branch'];
                $sql = $sql . " AND B.location = '" .$branch."'"; 
            }
            if(!empty($_POST['category'])){
                $category=$_POST['category'];
                $sql = $sql . " AND T.category = '" .$category."'"; 
            }
            if(!empty($_POST['number_of_seats'])){
                $number_of_seats=$_POST['number_of_seats'];
                $sql = $sql . " AND T.number_of_seats >= " .$number_of_seats;
            }
            if(!empty($_POST['minprice'])){
                $minprice=$_POST['minprice'];
                $sql = $sql . " AND T.price_per_hour >= " .$minprice;
            }
            if(!empty($_POST['maxprice'])){
                $maxprice=$_POST['maxprice'];
                $sql = $sql . " AND T.price_per_hour <= " .$maxprice;
            }
            $_SESSION['myquery']=$sql;
            $_SESSION['reservation_from']=$reservation_from_datetime;
            $_SESSION['reservation_to']=$reservation_to_datetime;
            $_SESSION['cust_id']=$customer_id;
            header("Location: available_tables.php");
        }
    ?>
    </div>
        <div id="rightDIV">
            <br>
            <h1 style="position:relative; right:3px;">Search for a table</h1>
            <div style="position: relative; bottom:70px;">
            <form style="width: 450px;position: relative;left: 150px" onsubmit= 'return validateDateTime(document.forms["searchForm"]["reservation_date"].value, document.forms["searchForm"]["reservation_hour_from"].value, document.forms["searchForm"]["reservation_hour_to"].value) && validateBranch(document.forms["searchForm"]["branch"].value) && validateCategory(document.forms["searchForm"]["category"].value) && validateSeats(document.forms["searchForm"]["number_of_seats"].value) && validatePrice(document.forms["searchForm"]["minprice"].value) && validatePrice(document.forms["searchForm"]["maxprice"].value)' name="searchForm" action="#" method = "POST">

                <div class="form-group">
                    <h3>Enter the required reservation time<br>(Note: Operating hours are from 09:00 to 23:00)</h3>
                    <input id='reservation_date' type="text" class="form-control" name="reservation_date" autocomplete="on" placeholder="Reservation Date (YYYY-MM-DD)">
                    <br>
                    <input id='reservation_hour_from' type="text" class="form-control" name="reservation_hour_from" autocomplete="on" placeholder="Start Time (HH - 24-hour format)">
                    <br>
                    <input id='reservation_hour_to' type="text" class="form-control" name="reservation_hour_to" autocomplete="on" placeholder="End Time (HH - 24-hour format)">
                    <br>
                    <h3>Enter further specifications</h3>
                    <input id="branch" type="text" class="form-control" name="branch" autocomplete="on" placeholder="Branch...">
                    <br>
                    <input id="category" type="text" class="form-control" name="category" autocomplete="on" placeholder="Category...">
                    <br>
                    <input id="number_of_seats" type="text" class="form-control" name="number_of_seats" autocomplete="on"  placeholder="Number of seats...">
                    <br>
                    <h3>Enter the price range (Hourly rate)</h3>
                    <input id='minprice' type="text" class="form-control" name="minprice" autocomplete="on" placeholder="Minimum Price...">
                    <br>
                    <input id='maxprice' type="text" class="form-control" name="maxprice" autocomplete="on" placeholder="Maximum Price...">
                    <button style="position:relative; top:15px; left: 160px;"id='button' type="submit" name="submit" class="btn btn-primary">Search</button>
                    <br>
                    <p id ="log-link" style="position:relative; bottom:15px; left: 300px;">Back to <a id ="log-link" href="index.html">Login</a></p>
                </div>
            </form>
        </div>
    </div>
    </body>
    <script src="scripts/customer_start.js"> </script>
   

</html>