<!DOCTYPE html>
<html lang="en">
<head>
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
                <h2 class="pull-left">Patient Details</h2>
            </div>
            <?php
            error_reporting(0);
            require_once $_SERVER['DOCUMENT_ROOT'] . "/DB/dbConfig.php";

            $roll_no = $_POST[roll_no];
            $sql = "SELECT * FROM patients where pk = '$roll_no'";
            if ($result = mysqli_query($link, $sql)) {
                if (mysqli_num_rows($result) > 0) {
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
                    while ($row = mysqli_fetch_array($result)) {
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
                        echo "<a href='readPage.php?id=" . $row['id'] . "' title='View Record' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
                        echo "<a href='updatePage.php?id=" . $row['id'] . "' title='Update Record' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
                        echo "<a href='deletePage.php?id=" . $row['id'] . "' title='Delete Record' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                    echo "</tbody>";
                    echo "</table>";
                    // Free result set
                    mysqli_free_result($result);
                } else {
                    echo "<p class='lead'><em>No records were found.</em></p>";
                }
            } else {
                echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
            }

            // Close connection
            mysqli_close($link);
            ?>
        </div>
    </div>
</div>
</body>
</html>