<?php
require('database.php');

if (isset($_POST['submit2'])) {
    $start = $_POST['start2'];
    $end = $_POST['end2'];

    if ($start == "" && $end == "") {
        $query = "SELECT
            DATE(r.`from`) AS payment_day,
            b.location AS branch_name,
            t.branch_id,
            SUM(r.cost) AS total_daily_payments
        FROM
            RESERVATION r
        JOIN
            `TABLE` t ON r.table_id = t.table_id
        JOIN
            BRANCH b ON t.branch_id = b.branch_id
        GROUP BY
            payment_day, t.branch_id, branch_name
        ORDER BY
            payment_day, t.branch_id;";
    } elseif ($start == "") {
        $query = "SELECT
            DATE(r.`from`) AS payment_day,
            b.location AS branch_name,
            t.branch_id,
            SUM(r.cost) AS total_daily_payments
        FROM
            RESERVATION r
        JOIN
            `TABLE` t ON r.table_id = t.table_id
        JOIN
            BRANCH b ON t.branch_id = b.branch_id
        WHERE
            (r.`from` <= '" . $end . " 23:59:59')
        GROUP BY
            payment_day, t.branch_id, branch_name
        ORDER BY
            payment_day, t.branch_id;";
    } elseif ($end == "") {
        $query = "SELECT
            DATE(r.`from`) AS payment_day,
            b.location AS branch_name,
            t.branch_id,
            SUM(r.cost) AS total_daily_payments
        FROM
            RESERVATION r
        JOIN
            `TABLE` t ON r.table_id = t.table_id
        JOIN
            BRANCH b ON t.branch_id = b.branch_id
        WHERE
            (r.`from` >= '" . $start . " 00:00:00')
        GROUP BY
            payment_day, t.branch_id, branch_name
        ORDER BY
            payment_day, t.branch_id;";
    } else {
        $query = "SELECT
            DATE(r.`from`) AS payment_day,
            b.location AS branch_name,
            t.branch_id,
            SUM(r.cost) AS total_daily_payments
        FROM
            RESERVATION r
        JOIN
            `TABLE` t ON r.table_id = t.table_id
        JOIN
            BRANCH b ON t.branch_id = b.branch_id
        WHERE
            (r.`from` >= '" . $start . " 00:00:00' AND r.`from` <= '" . $end . " 23:59:59')
        GROUP BY
            payment_day, t.branch_id, branch_name
        ORDER BY
            payment_day, t.branch_id;";
    }

    $query = mysqli_query($database_connection, $query);
    $count = mysqli_num_rows($query);

    if ($count != 0) {
        echo '
            <br><br><br><br>
            <h1>Daily Payments</h1>
            <link href="stylefile.css" rel="stylesheet" type="text/css"/>
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
            <table class="table custom-table" border="0" cellspacing="2" cellpadding="2">
                <tr>
                    <thead class="thead-dark">
                        <th scope="col"> <font face="Arial">Day</font> </th>
                        <th scope="col"> <font face="Arial">Branch Location</font> </th>
                        <th scope="col"> <font face="Arial">Total Payment</font> </th>
                    </thead>
                </tr>
        ';

        while ($row = mysqli_fetch_assoc($query)) {
            $field1name = $row["payment_day"];
            $field2name = $row["total_daily_payments"];
            $field3name = $row["branch_name"];
            echo '<tr>
                    <td>' . $field1name . '</td>
                    <td>' . $field3name . '</td>
                    <td>' . $field2name . '</td>
                </tr>';
        }
    } else {
        echo '<div style="position: relative; top: 100;">
                <h2 style="position: relative; color: red; left: 600px; top: 200px; font-size:50px;"> No payments are made in this period.</h2>
            </div>';
    }
}
?>
