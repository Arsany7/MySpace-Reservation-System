<?php
require('database.php');
  if(isset($_POST['submit']))
  {
    $date=$_POST['date']; 
    $start=$_POST['start_time'];
    $end=$_POST['end_time'];
  if ($date == "" && $start == "" && $end == "")
   {
      $query="select cust_id, fname, lname, email, phone_number, profession, cost, reserved_hours, category, price_per_hour, number_of_seats, branch_id  from reservation Natural Join `table` Natural Join customer";
   }
   else if ($date != "" && $start == "" && $end == "")
   {
    $query="select cust_id, fname, lname, email, phone_number, profession, cost, reserved_hours, category, price_per_hour, number_of_seats, branch_id from reservation Natural Join `table` Natural Join customer where DATE (`from`) ='".$date."'";
   }
   else if ($date != "" && $start != "" && $end == "")
   {
    $query="select cust_id, fname, lname, email, phone_number, profession, cost, reserved_hours, category, price_per_hour, number_of_seats, branch_id  from reservation Natural Join `table` Natural Join customer where DATE (`from`) = '".$date."' and HOUR(`from`) >= '".$start."'";
   }
   else
   {
    $query="select cust_id, fname, lname, email, phone_number, profession, cost, reserved_hours, category, price_per_hour, number_of_seats, branch_id  from reservation Natural Join `table` Natural Join customer where DATE (`from`) = '".$date."' and HOUR(`from`) >='".$start."' and HOUR(`to`) <='".$end."'";
   }
    $query=mysqli_query($database_connection,$query); 
    $count=mysqli_num_rows($query);
    if($count!=0){ 
    echo 
    '
    <br><br><br><br>
    <h1>Reservations</h1>
    <link href="stylefile.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <table class="table custom-table" border="0" cellspacing="2" cellpadding="2"> 
    <tr> 
    <thead class="thead-dark">    
      <th scope="col"> <font face="Arial">Customer Id</font> </th> 
      <th scope="col"> <font face="Arial"> First Name</font> </th> 
      <th scope="col"> <font face="Arial"> Last Name</font> </th> 
      <th scope="col"> <font face="Arial"> Email</font> </th> 
      <th scope="col"> <font face="Arial">Phone Number</font> </th> 
      <th scope="col"> <font face="Arial">Profession</font> </th> 
      <th scope="col"> <font face="Arial">Cost</font> </th> 
      <th scope="col"> <font face="Arial">Number of Reserved Hours</font> </th> 
      <th scope="col"> <font face="Arial">Category</font> </th> 
      <th scope="col"> <font face="Arial">Price per Hour</font> </th> 
      <th scope="col"> <font face="Arial"> Number of Seats</font> </th> 
      <th scope="col"> <font face="Arial"> Branch Id</font> </th> 
      </thead>    
    </tr>';

 
  while($row = mysqli_fetch_assoc($query)){
      $field1name = $row["cust_id"];
      $field2name = $row["fname"]; 
      $field3name = $row["lname"]; 
      $field4name = $row["email"]; 
      $field5name = $row["phone_number"]; 
      $field6name = $row["profession"];
      $field7name = $row["cost"];
      $field8name = $row["reserved_hours"];
      $field9name = $row["category"]; 
      $field10name = $row["price_per_hour"];
      $field11name = $row["number_of_seats"]; 
      $field12name = $row["branch_id"];

      echo '<tr> 
            <td>'.$field1name.'</td> 
            <td>'  .$field2name.'</td> 
            <td>'  .$field3name.'</td> 
            <td>'  .$field4name.'</td> 
            <td>'  .$field5name.'</td> 
            <td>'  .$field6name.'</td> 
            <td>'  .$field7name.'</td> 
            <td>'  .$field8name.'</td> 
            <td>'  .$field9name.'</td> 
            <td>'  .$field10name.'</td> 
            <td>'  .$field11name.'</td> 
            <td>'  .$field12name.'</td> 
        </tr>';
  }
}
  else
{
  echo' <div style="position: relative; top: 100;">
  <h2 style="position: relative; color: red; left: 600px; top: 200px; font-size:50px;"> No reservations in this period.</h2>
  </div>';
}
}


?>