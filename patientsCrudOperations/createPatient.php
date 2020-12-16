<?php
// Include config file
//require_once "DB/dbConfig.php";
require_once $_SERVER['DOCUMENT_ROOT']."/DB/dbConfig.php";
//next line catch sql errors and view it on screen
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
// Define variables and initialize with empty values
$date = $name = $lastname = $complaintshistory = $adjacentdiseases = $allergies = $pk = "";
$date_err = $name_err = $lastname_err = $complaintshistory_err = $adjacentdiseases_err = $allergies_err = $pk_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate name
    $input_date = trim($_POST["date"]);
    if (empty($input_date)) {
        $date_err = "Please enter a date.";

    } else {
        $date = $input_date;
    }

    // Validate address
    $input_name = trim($_POST["name"]);
    if (empty($input_name)) {
        $name_err = "Please enter a name.";
    } else {
        $name = $input_name;
    }

    // Validate salary
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



    $sql = "INSERT INTO patients (date, name, lastname, complaintshistory, 
                                    adjacentdiseases, allergies, pk) VALUES (?, ?, ?, ?, ?, ?, ?)";

    if ($stmt = mysqli_prepare($link, $sql)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "sssssss",$param_date,
            $param_name, $param_lastname, $param_complaintshistory, $param_adjacentdiseases,
            $param_allergies, $param_pk);

        // Set parameters
        $param_date = $date;
        $param_name = $name;
        $param_lastname = $lastname;
        $param_complaintshistory = $complaintshistory;
        $param_adjacentdiseases = $adjacentdiseases;
        $param_allergies = $allergies;
        $param_pk = $pk;

        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            // Records created successfully. Redirect to landing page
            header("location: http://localhost:63342/MFDPHP/landingPages/patientsLandingPage.php");
            exit();
        } else {
            echo "Something went wrong. Please try again later.";
        }
    }

    // Close statement
    mysqli_stmt_close($stmt);
//    }

    // Close connection
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper {
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header">
                    <h2>Create Record</h2>
                </div>
                <p>Please fill this form and submit to add patient record to the database.</p>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

                    <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                        <label>Vards</label>
                        <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                        <span class="help-block"><?php echo $name_err; ?></span>
                    </div>

                    <div class="form-group <?php echo (!empty($lastname_err)) ? 'has-error' : ''; ?>">
                        <label>Uzvards</label>
                        <input type="text" name="lastname" class="form-control" value="<?php echo $lastname; ?>">
                        <span class="help-block"><?php echo $lastname_err; ?></span>
                    </div>

                    <div class="form-group <?php echo (!empty($complaintshistory_err)) ? 'has-error' : ''; ?>">
                        <label>Sūdzības un anamnēze</label>
                        <input type="text" name="complaintshistory" class="form-control" value="<?php echo $complaintshistory; ?>">

                    </div>

                    <div class="form-group <?php echo (!empty($adjacentdiseases_err)) ? 'has-error' : ''; ?>">
                        <label>Blakus slimības</label>
                        <input type="text" name="adjacentdiseases" class="form-control"
                               value="<?php echo $adjacentdiseases; ?>">
                    </div>

                    <div class="form-group <?php echo (!empty($allergies_err)) ? 'has-error' : ''; ?>">
                        <label>Medikamentu nepanesamība, alerģijas</label>
                        <input type="text" name="allergies" class="form-control"
                               value="<?php echo $allergies; ?>">
                    </div>

                    <div class="form-group ">
                        <label>PK</label>
                        <input type="text" name="pk" class="form-control" value="<?php echo $pk; ?>">
                    </div>

                    <div class="form-group">
                        <label>Datums</label>
                        <input type="datetime-local" name="date" value="<?php echo $date; ?>">
                    </div>


                    <input type="submit" class="btn btn-primary" value="Submit">
                    <a href="index.php" class="btn btn-default">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>