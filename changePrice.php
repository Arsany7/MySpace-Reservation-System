<?php
require('database.php');
if(isset($_POST['validate']))
{
   $table_id=$_POST['table_id'];
   $price_per_hour= $_POST['price'];
 
   $query1=mysqli_query($database_connection,"select * from `table` where table_id='".$table_id."'"); 
   if(mysqli_num_rows($query1) == 0)
    {
        echo ("fail");
        exit();
    }
   
        $sql = "update `table` set price_per_hour = '".$price_per_hour."' where table_id = '".$table_id."'";
        if (mysqli_query($database_connection, $sql)) {
            echo ("success");
            exit();
        }
    }
mysqli_close($database_connection);
?>
