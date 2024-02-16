<?php
require('database.php');
   $query=mysqli_query($database_connection, "select * from `table` join branch on `table`.branch_id = branch.branch_id"); 
   $count=mysqli_num_rows($query);
   if($count!=0){       
    echo '
    <br><br><br><br>
    <h1>Tables</h1>
    <link href="stylefile.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <table class="table custom-table" border="0" cellspacing="2" cellpadding="2"> 
    <tr> 
    <thead class="thead-dark">    
          <th  scope="col"> <font face="Arial">Table ID</font> </th> 
          <th  scope="col"> <font face="Arial">Category</font> </th> 
          <th  scope="col"> <font face="Arial">Number of seats</font> </th> 
          <th  scope="col"> <font face="Arial">Price per hour</font> </th> 
          <th  scope="col"> <font face="Arial">Branch Location</font> </th> 
        </thead>
        </tr>
        ';
        while($row = mysqli_fetch_assoc($query)){
      $field1name = $row["table_id"];
      $field2name = $row["category"];
      $field3name = $row["number_of_seats"];
      $field4name = $row["price_per_hour"];
      $field5name = $row["location"];
      echo '<tr> 
            <td>'.$field1name.'</td> 
            <td>'  .$field2name.'</td> 
            <td>'  .$field3name.'</td> 
            <td>'  .$field4name.'</td> 
            <td>'  .$field5name.'</td> 
        </tr>';
  }
}
else
{
  echo' <div style="position: relative; top: 100;">
  <h2 style="position: relative; color: red; left: 600px; top: 200px; font-size:50px;"> No Tables On System</h2>
  </div>';
}

?>