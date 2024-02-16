<?php
require('database.php');
if(isset($_POST['submit4']))
{  
  $query = "SELECT * FROM `TABLE` as T NATURAL JOIN RESERVATION as R NATURAL JOIN BRANCH as B WHERE 1";
  
  if (!empty($_POST['start4'])) {
      $start = $_POST['start4'];
      $query .= " AND DATE(`from`) >= '$start'";
  }
  
  if (!empty($_POST['end4'])) {
      $end = $_POST['end4'];
      $query .= " AND DATE(`to`) <= '$end'";
  }
  
  if (!empty($_POST['category'])) {
      $category = $_POST['category'];
      $query .= " AND T.category = '$category'";
  }
  
  if (!empty($_POST['number_of_seats'])) {
      $number_of_seats = $_POST['number_of_seats'];
      $query .= " AND T.number_of_seats >= '$number_of_seats'";
  }
  
  if (!empty($_POST['price4'])) {
      $price = $_POST['price4'];
      $query .= " AND T.price_per_hour <= '$price'";
  }
  
  if (!empty($_POST['branch'])) {
      $branch = $_POST['branch'];
      $query .= " AND B.location = '$branch'";
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

      <th scope="col"> <font face="Arial">Table Id</font> </th> 
      <th scope="col"> <font face="Arial"> Category</font> </th> 
      <th scope="col"> <font face="Arial"> Number of Seats</font> </th> 
      <th scope="col"> <font face="Arial"> Price</font> </th> 
      <th scope="col"> <font face="Arial"> Branch ID</font> </th> 
      <th scope="col"> <font face="Arial"> Customer ID</font> </th> 
      <th scope="col"> <font face="Arial"> From</font> </th> 
      <th scope="col"> <font face="Arial"> To</font> </th> 
      <th scope="col"> <font face="Arial">Cost</font> </th> 
      <th scope="col"> <font face="Arial">Reserved Hours</font> </th> 
    </thead>  
    </tr>  
    ';

 
  while($row = mysqli_fetch_assoc($query)){
    $field1name = $row["table_id"];
    $field2name = $row["category"];
    $field3name = $row["number_of_seats"];
    $field4name = $row["price_per_hour"];
    $field5name = $row["branch_id"];
    $field6name = $row["cust_id"]; 
    $field7name = $row["from"];
    $field8name = $row["to"];
    $field9name = $row["cost"];
    $field10name = $row["reserved_hours"];

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
        </tr>';
  }
}
  else
  {
    echo' <div style="position: relative; top: 100;">
    <h2 style="position: relative; color: red; left: 600px; top: 200px; font-size:50px;"> No Tables is reserved in this period.</h2>
    </div>';
  }
}
?>



