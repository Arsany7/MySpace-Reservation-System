<?php
require('database.php');
if(isset($_POST['submit3']))
{
   $date=$_POST['date'];
   $query = mysqli_query($database_connection, "
    SELECT 
        table_status.table_id, 
        table_status.state,
        table_status.`from`,
        table_status.`to`,
        branch.branch_id,   -- Specify the table alias for branch_id
        branch.location     -- Specify the table alias for location
    FROM 
        table_status 
    JOIN 
        `table` ON `table`.table_id = table_status.table_id 
    JOIN 
        branch ON `table`.branch_id = branch.branch_id 
    WHERE 
        ('$date' BETWEEN DATE(table_status.`from`) AND DATE(table_status.`to`)) OR 
        ('$date' >= DATE(table_status.from) AND DATE(table_status.to) IS NULL)
");

   $count=mysqli_num_rows($query);
   if($count!=0){  
    echo '
    <br><br><br><br>
    <h1>Table Status</h1>
    <link href="stylefile.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <table class="table custom-table" border="0" cellspacing="2" cellpadding="2"> 
        <tr> 
        <thead class="thead-dark">    
          <th  scope="col"> <font face="Arial">Table ID</font> </th> 
          <th  scope="col"> <font face="Arial">Branch</font> </th> 
          <th  scope="col"> <font face="Arial">State</font> </th> 
          <th  scope="col"> <font face="Arial">From</font> </th> 
          <th  scope="col"> <font face="Arial">To</font> </th> 
        </thead>  
        </tr>  
        ';
        while($row = mysqli_fetch_assoc($query)){
            $field1name = $row["table_id"];
            $field2name = $row["location"];
            $field3name = $row["state"];
            $field4name = $row["from"];
            $field5name = $row["to"];

            echo '<tr> 
                  <td>'.$field1name.'</td> 
                  <td>'.$field2name.'</td> 
                  <td>'  .$field3name.'</td> 
                  <td>'.$field4name.'</td> 
                  <td>'.$field5name.'</td> 
              </tr>';
        }
      }
      else
      {
        echo' <div style="position: relative; top: 100;">
        <h2 style="position: relative; color: red; left: 600px; top: 200px; font-size:50px;"> No Tables are present on this day.</h2>
        </div>';
      }

}
?>