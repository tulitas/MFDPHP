<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
    <script src="/sources/script/patientsLandingPage.js"></script>
    <link href="/sources/css/patientsLandingPage.css">

</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="page-header clearfix">
                <h2 class="pull-left">Flat Details</h2>
                <a href="createPage.php" class="btn btn-success pull-right">Add New Flat</a>
            </div>
            <?php
            // Include config file
            require_once $_SERVER['DOCUMENT_ROOT']."/DB/dbConfig.php";

            // Attempt select query execution
            $sql = "SELECT * FROM patients";
            if($result = mysqli_query($link, $sql)){
                if(mysqli_num_rows($result) > 0){
                    echo "<table class='table table-bordered table-striped'>";
                    echo "<thead>";
                    echo "<tr>";
                    echo "<th>Datums</th>";
                    echo "<th>Vards</th>";
                    echo "<th>Uzvards</th>";
                    echo "<th>Sūdzības un anamnēze</th>";
                    echo "<th>Blakus slimības</th>";
                    echo "<th>Medikamentu neparnesamība, alerģijas</th>";
                    echo "<th>Personas Kods</th>";
                    echo "<th>Action</th>";
                    echo "</tr>";
                    echo "</thead>";
                    echo "<tbody>";
                    while($row = mysqli_fetch_array($result)){
                        echo "<tr>";
//                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['date'] . "</td>";
                        echo "<td>" . $row['name'] . "</td>";
                        echo "<td>" . $row['lastname'] . "</td>";
                        echo "<td>" . $row['complaintshistory'] . "</td>";
                        echo "<td>" . $row['adjacentdiseases'] . "</td>";
                        echo "<td>" . $row['allergies'] . "</td>";
                        echo "<td>" . $row['pk'] . "</td>";
                        echo "<td>";
                        echo "<a href='readPage.php?id=". $row['id'] ."' title='View Record' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
                        echo "<a href='patientUpdatePage.php?id=". $row['id'] ."' title='Update Record' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
                        echo "<a href='deletePage.php?id=". $row['id'] ."' title='Delete Record' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                    echo "</tbody>";
                    echo "</table>";
                    // Free result set
                    mysqli_free_result($result);
                } else{
                    echo "<p class='lead'><em>No records were found.</em></p>";
                }
            } else{
                echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
            }

            // Close connection
            mysqli_close($link);
            ?>
        </div>
    </div>
</div>
<a href="/MFDPHP/index.php">home</a>
</body>
</html>