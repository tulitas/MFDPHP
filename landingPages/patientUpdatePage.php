<?php
// Include config file
require_once $_SERVER['DOCUMENT_ROOT'] . "/DB/dbConfig.php";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
// Define variables and initialize with empty values
$date = $name = $lastname = $complaintshistory = $adjacentdiseases = $allergies = $pk = "";
$date_err = $name_err = $lastname_err = $complaintshistory_err = $adjacentdiseases_err = $allergies_err = $pk_err = "";

// Processing form data when form is submitted
if (isset($_POST["id"]) && !empty($_POST["id"])) {
    // Get hidden input value
    $id = $_POST["id"];

    $input_county = trim($_POST["name"]);
    if (empty($input_name)) {
        $name_err = "Please enter a name.";
    } else {
        $name = $input_name;
    }

    $input_date = trim($_POST["date"]);
    if (empty($input_date)) {
        $date_err = "Please enter a date.";
    } else {
        $date = $input_date;
    }

    $input_lastname = trim($_POST["lastname"]);
    if (empty($input_lastname)) {
        $lastname_err = "Please enter the lastname.";
    } else {
        $lastname = $input_lastname;
    }

    $input_complaintshistory = trim($_POST["complaintshistory"]);
    if (empty($input_complaintshistory)) {
        $complaintshistory_err = "Please enter the complaintshistory.";
    } else {
        $complaintshistory = $input_complaintshistory;
    }

    $input_adjacentdiseases = trim($_POST["adjacentdiseases"]);
    if (empty($input_adjacentdiseases)) {
        $adjacentdiseases_err = "Please enter the adjacentdiseases.";
    } else {
        $adjacentdiseases = $input_adjacentdiseases;
    }

    $input_allergies = trim($_POST["allergies"]);
    if (empty($input_allergies)) {
        $allergies_err = "Please enter the allergies.";
    } else {
        $allergies = $input_allergies;
    }

    $input_pk = trim($_POST["pk"]);
    if (empty($input_pk)) {
        $pk_err = "Please enter the pk.";
    } else {
        $pk = $input_pk;
    }
// Check input errors before inserting in database
    if (empty($county_err) && empty($country_err) && empty($town_err)) {
        // Prepare an update statement
        $sql = "UPDATE patients SET pk=?, date=?, name=?, lastname=?,
                                complaintshistory=?, adjacentdiseases=?,
                                 allergies=?  where id=?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssssss", $param_pk,$param_date,
                $param_name, $param_lastname,
                $param_complaintshistory, $param_adjacentdiseases,
                $param_allergies
                );

            // Set parameters
            $param_pk = $pk;
            $param_date = $date;
            $param_name = $name;
            $param_lastname = $lastname;
            $param_complaintshistory = $complaintshistory;
            $param_adjacentdiseases = $adjacentdiseases;
            $param_allergies = $allergies;



            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Records updated successfully. Redirect to landing page
                header("location: http://localhost:63342/MFDPHP/landingPages/patientsLandingPage.php");
                exit();
            } else {
                echo "Something went wrong. Please try again later.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);

    }
    // Close connection
    mysqli_close($link);

} else {
    // Check existence of id parameter before processing further
    if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
        // Get URL parameter
        $id = trim($_GET["id"]);

        // Prepare a select statement
        $sql = "SELECT * FROM patients WHERE id = ?";
        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_id);

            // Set parameters
            $param_id = $id;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                $result = mysqli_stmt_get_result($stmt);

                if (mysqli_num_rows($result) == 1) {
                    /* Fetch result row as an associative array. Since the result set contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                    // Retrieve individual field value
                    $pk = $row["pk"];
                    $date = $row["date"];
                    $name = $row["name"];
                    $lastname = $row["lastname"];
                    $complaintshistory = $row["complaintshistory"];
                    $adjacentdiseases = $row["adjacentdiseases"];
                    $allergies = $row["allergies"];


                } else {
                    // URL doesn't contain valid id. Redirect to error page
//                    header("location: error.php");
                    exit();
                }

            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);

        // Close connection
        mysqli_close($link);
    } else {
        // URL doesn't contain id parameter. Redirect to error page
//        header("location: error.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper {
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
<div class="page-header">
    <h2>Update Record</h2>
</div>
<p>Please edit the input values and submit to update the record.</p>
<form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">

    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label>Personas Kods</label>
                    <input type="text" name="pk" class="form-control" value="<?php echo $pk; ?>">
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group <?php echo (!empty($date_err)) ? 'has-error' : ''; ?>">
                    <label>Datums</label>
                    <input type="text" name="date" class="form-control" value="<?php echo $date; ?>">
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                    <label>Vards</label>
                    <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group <?php echo (!empty($lastname_err)) ? 'has-error' : ''; ?>">
                    <label>Uzvards</label>
                    <input type="text" name="lastname" class="form-control"
                           value="<?php echo $lastname; ?>">
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group <?php echo (!empty($complaintshistory_err)) ? 'has-error' : ''; ?>">
                    <label>Sūdzības un anamnēze</label>
                    <textarea name="complaintshistory" class="form-control"><?php echo $complaintshistory; ?></textarea>
                </div>
            </div>


            <div class="col-md-12">
                <div class="form-group <?php echo (!empty($adjacentdiseases_err)) ? 'has-error' : ''; ?>">
                    <label>Blakus slimības</label>
                    <textarea name="adjacentdiseases" class="form-control"><?php echo $adjacentdiseases; ?></textarea>
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group <?php echo (!empty($allergies_err)) ? 'has-error' : ''; ?>">
                    <label>Medikamentu nepanesamība, alerģijas</label>
                    <textarea name="allergies" class="form-control"><?php echo $allergies; ?></textarea>
                </div>
            </div>

            <div class="col-md-3">
                <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                <input type="submit" class="btn btn-primary" value="Submit">
                <a href="../index.php" class="btn btn-default">Cancel</a>
            </div>
        </div>
    </div>
</form>
</div>
</body>
</html>

