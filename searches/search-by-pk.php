<?php
error_reporting(0);
require_once $_SERVER['DOCUMENT_ROOT']."/DB/dbConfig.php";
if(count($_POST)>0) {
    $roll_no=$_POST[roll_no];
   $sql = "SELECT * FROM patients where pk = '$roll_no'";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title> Retrive data</title>
    <style>
        table, th, td {
            border: 1px solid black;
        }
    </style>
</head>
<body>
<table>
    <tr>
        <td>County</td>
        <td>Country</td>
        <td>Town</td>
        <td>Price</td>
        <td>Number of bathrooms</td>
        <td>Property type</td>
        <td>Deal</td>


    </tr>
    <?php
    $i=0;
    while($row = mysqli_fetch_array($sql)) {
        ?>
        <tr>
            <td><?php echo $row["name"]; ?></td>
            <td><?php echo $row["lastname"]; ?></td>
            <td><?php echo $row["date"]; ?></td>
            <td><?php echo $row["complaintshistory"]; ?></td>
            <td><?php echo $row["adjacentdiseases"]; ?></td>
            <td><?php echo $row["allergies"]; ?></td>
            <td><?php echo $row["pk"]; ?></td>

        </tr>
        <?php
        $i++;
    }
    ?>
</table>
<a href="landingPage.php">landing page</a><br>
</body>
</html>