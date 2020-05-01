<?php 

// Include config file
require_once "lib/crud.php";

// Define variables and initialize with empty values
$name = $cprnr = $charges = $penalty = $seized = $incident = $recognizing = "";
$name_err = $cprnr_err = $charges_err = $penalty_err = $seized_err = $incident_err = $recognizing_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate name
    $input_name = trim($_POST["name"]);
    if(empty($input_name)) {
        $name_err = "Please enter a name.";
    } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))) {
        $name_err = "Please enter a valid name.";
    } else {
        $name = $input_name;
    }

    // Validate cprnr
    $input_cprnr = trim($_POST["cprnr"]);
    if(empty($input_cprnr)) {
        $cprnr_err = "Please enter cpr nr.";
    } else {
        $cprnr = $input_cprnr;
    }

    // Validate charges
    $input_charges = trim($_POST["charges"]);
    if(empty($input_charges)) {
        $charges_err = "Please enter charges.";
    } else {
        $charges = $input_charges;
    }

    // Validate penalty
    $input_penalty = trim($_POST["penalty"]);
    if(empty($input_penalty)) {
        $penalty_err = "Please enter penalty.";
    } else {
        $penalty = $input_penalty;
    }

    // Validate seized
    $input_seized = trim($_POST["seized"]);
    if(empty($input_seized)) {
        $seized_err = "Please enter seized items.";
    } else {
        $seized = $input_seized;
    }

    // Validate incident
    $input_incident = trim($_POST["incident"]);
    if(empty($input_incident)) {
        $incident_err = "Please enter incident.";
    } else {
        $incident = $input_incident;
    }

    // Validate recognizing
    $input_recognizing = trim($_POST["recognizing"]);
    if(empty($input_recognizing)) {
        $recognizing_err = "Skriv om han erkender eller ikke erkender.";
    } else {
        $recognizing = $input_recognizing;
    }

    // Check input erros before inserting in database
    if(empty($name_err) && empty($cprnr_err) && empty($charges_err) && empty($penalty_err) && empty($seized_err) && empty($incident_err) && empty($recognizing_err)) {
        // Prepare an insert statement
        $sql = "INSERT INTO reports (name, cprnr, charges, penalty, seized, incident, recognizing) VALUES (:name, :cprnr, :charges, :penalty, :seized, :incident, :recognizing)";

        if($stmt = $pdo->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":name", $param_name);
            $stmt->bindParam(":cprnr", $param_cprnr);
            $stmt->bindParam(":charges", $param_charges);
            $stmt->bindParam(":penalty", $param_penalty);
            $stmt->bindParam(":seized", $param_seized);
            $stmt->bindParam(":incident", $param_incident);
            $stmt->bindParam(":recognizing", $param_recognizing);

            // Set parameters
            $param_name = $name;
            $param_cprnr = $cprnr;
            $param_charges = $charges;
            $param_penalty = $penalty;
            $param_seized = $seized;
            $param_incident = $incident;
            $param_recognizing = $recognizing;

            // Attempt to execute the prepared statement
            if($stmt->execute()) {
                // Records created successfully. Redirect to landing page
                header("location: reports.php");
                exit();
            } else {
                echo "Something went wrong. Please try again later.";
            }
        }

        // Close statement
        unset($stmt);
    }

    // Close connection
    unset($pdo);
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
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
                    <p>Please fill this form and submit to add employee record to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                            <span class="help-block"><?php echo $name_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($cprnr_err)) ? 'has-error' : ''; ?>">
                            <label>CPR NR</label>
                            <input type="text" name="cprnr" class="form-control" value="<?php echo $cprnr; ?>">
                            <span class="help-block"><?php echo $cprnr_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($charges_err)) ? 'has-error' : ''; ?>">
                            <label>Sigtelser</label>
                            <input type="text" name="charges" class="form-control" value="<?php echo $charges; ?>">
                            <span class="help-block"><?php echo $charges_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($penalty_err)) ? 'has-error' : ''; ?>">
                            <label>Straf</label>
                            <input type="text" name="penalty" class="form-control" value="<?php echo $penalty; ?>">
                            <span class="help-block"><?php echo $penalty_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($seized_err)) ? 'has-error' : ''; ?>">
                            <label>Beslaglagte ting</label>
                            <input type="text" name="seized" class="form-control" value="<?php echo $seized; ?>">
                            <span class="help-block"><?php echo $seized_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($incident_err)) ? 'has-error' : ''; ?>">
                            <label>Hændelse</label>
                            <textarea class="form-control" name="incident" rows="3"><?php echo $incident; ?></textarea>
                            <span class="help-block"><?php echo $incident_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($recognizing_err)) ? 'has-error' : ''; ?>">
                            <label>Erkender</label>
                            <input type="text" name="recognizing" class="form-control" value="<?php echo $recognizing; ?>">
                            <span class="help-block"><?php echo $recognizing_err;?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit">
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>