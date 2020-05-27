<?php
// Check existence of id parameter before processing further
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
    // Include config file
    require_once "lib/config.php";

    // Prepare a select statement
    $sql = "SELECT * FROM reports WHERE id = ?";

    if($stmt = mysqli_prepare($link, $sql)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_id);

        // Set parameters
        $param_id = trim($_GET["id"]);

        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);

            if(mysqli_num_rows($result) == 1) {
                /* Fetch result row as an associative array. Since the result set contains only one row, we don't need to use while loop */
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                // Retrieve individual field value
                $name = $row["name"];
                $cprnr = $row["cprnr"];
                $charges = $row["charges"];
                $penalty = $row["penalty"];
                $seized = $row["seized"];
                $incident = $row["incident"];
                $recognizing = $row["recognizing"];
            } else {
                // URL doesn't contain valid id parameter. Redirect to error page
                header("location: error.php");
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
    header("location: error.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
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
    <h1><?php echo $name . "-" . $cprnr; ?></h1>
    </div>
    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group <?php echo (!empty($charges_err)) ? 'has-error' : ''; ?>">
                            <label>Sigtelser</label>
                            <input type="text" name="charges" class="form-control" value="<?php echo $charges; ?>" readonly>
                        </div>
                        <div class="form-group <?php echo (!empty($penalty_err)) ? 'has-error' : ''; ?>">
                            <label>Straf</label>
                            <input type="text" name="penalty" class="form-control" value="<?php echo $penalty; ?>" readonly>
                        </div>
                        <div class="form-group <?php echo (!empty($seized_err)) ? 'has-error' : ''; ?>">
                            <label>Beslaglagte ting</label>
                            <input type="text" name="seized" class="form-control" value="<?php echo $seized; ?>" readonly>
                        </div>
                        <div class="form-group <?php echo (!empty($incident_err)) ? 'has-error' : ''; ?>">
                            <label>Hændelse</label>
                            <textarea class="form-control" name="incident" rows="3" readonly><?php echo $incident; ?></textarea>
                        </div>
                        <div class="form-group <?php echo (!empty($recognizing_err)) ? 'has-error' : ''; ?>">
                            <label>Erkender</label>
                            <input type="text" name="recognizing" class="form-control" value="<?php echo $recognizing; ?>" readonly>
                        </div>
                        <a href="reports.php" class="btn btn-primary">Tilbage</a>
                    </form>
    </div>
    </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    </body>
    </html>