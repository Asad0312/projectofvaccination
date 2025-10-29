<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointments Dashboard</title>
</head>
<body>

<h2>All Appointments</h2>

<table border="1" cellpadding="8" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Gender</th>
        <th>Date</th>
        <th>Department</th>
        <th>Massage</th>
    </tr>


<?php
include "../DBConnection.php";

$query = "SELECT * FROM `appoinment` ";
$result = mysqli_query($connection,$query);

foreach($result as $row)
    {
        echo "<tr>";
            echo "<td>$row[ID]</td>";
            echo "<td>$row[Name]</td>";
            echo "<td>$row[Email]</td>";
            echo "<td>$row[Phone]</td>";
            echo "<td>$row[Gender]</td>";
            echo "<td>$row[date]</td>";
            echo "<td>$row[department]</td>";
            echo "<td>$row[massage]</td>";
            

        echo "</tr>";
    }


?>