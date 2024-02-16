<?php
require('database.php');
if(isset($_POST['validate']))
{
   $category=$_POST['category'];
   $number_of_seats=$_POST['number_of_seats'];
   $price_per_hour=$_POST['price_per_hour'];
   $branch_id= $_POST['branch_id'];

    $query=mysqli_query($database_connection,"select * from branch where branch_id='".$branch_id."'"); 
   if(mysqli_num_rows($query) == 0)
    {
        echo ("fail");
        exit();
    }
        $sql = "insert into `table` (category, number_of_seats, price_per_hour, branch_id) values ('".$category."', '".$number_of_seats."', '".$price_per_hour."', '".$branch_id."')";
        if (mysqli_query($database_connection, $sql)) {
            echo ("success");
            exit();
        }
    }
mysqli_close($database_connection);
?>