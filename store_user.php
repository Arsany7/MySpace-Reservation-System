<?php
require('database.php');
if(isset($_POST['validate']))
{
   $fname=$_POST['fname'];
   $lname=$_POST['lname'];
   $email=$_POST['email'];
   $mobile_no=$_POST['mobile_no'];
   $profession=$_POST['profession'];
   $password=$_POST['password'];
   $query=mysqli_query($database_connection,"select * from customer where email='".$email."'"); 
   if(mysqli_num_rows($query) >= 1)
    {
        echo "fail";
    }
    else
    {
        $sql = "insert into customer (fname, lname, email, password, phone_number, profession) values ('$fname', '$lname', '$email', md5('$password'), '$mobile_no', '$profession')";
        if (mysqli_query($database_connection, $sql)) {
            $q3 = "SELECT cust_id FROM customer where email='".$email."' ";
            $row=mysqli_query($database_connection,$q3);
            $rowid = mysqli_fetch_assoc($row);
            session_start();
            $_SESSION['fname'] = $fname;
            $_SESSION['id']= $rowid["cust_id"];
            $_SESSION['reservation_confirmation'] = 'Successful Registration!';

            echo ("success");
            exit();
        }
    }
   }
mysqli_close($database_connection);
?>