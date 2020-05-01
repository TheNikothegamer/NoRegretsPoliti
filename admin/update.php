<?php

// Initialize the session
session_start();

// Check if the user is already logged in, if yes the redirect him to welcome page
/* if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true && $_SESSION["role"] === "admin") {
    header("location: calculator.php");
    exit;
} */

// Include config file
require_once "../lib/config.php";
 
// Define variables and initialize with empty values
$tid = $bøde = $navn = $beskrivelse = $kategori = "";
$tid_err = $bøde_err = $navn_err = $beskrivelse_err = $kategori_err = "";
 
// Processing form data when form is submitted
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Get hidden input value
    $id = $_POST["id"];
    
    // Validate name
    $input_navn = trim($_POST["navn"]);
    if(empty($input_navn)){
        $navn_err = "Indtast et navn.";
    } else{
        $navn = $input_navn;
    }
    
    // Validate address address
    $input_beskrivelse = trim($_POST["beskrivelse"]);
    if(empty($input_beskrivelse)){
        $beskrivelse_err = "Indtast en beskrivelse";     
    } else{
        $beskrivelse = $input_beskrivelse;
    }

    $input_bøde = trim($_POST["bøde"]);
    if(empty($input_bøde)) {
        $bøde_err = "Indtast en bøde.";
    } else {
        $bøde = $input_bøde;
    }

    $input_kategori = trim($_POST["kategori"]);
    if(empty($input_kategori)) {
        $kategori_err = "Indtast en kategori.";
    } else {
        $kategori = $input_kategori;
    }
    
    // Validate salary
    $input_tid = trim($_POST["tid"]);
    if(empty($input_tid)){
        $tid_err = "Indtast en tid";     
    } elseif(!ctype_digit($input_tid)){
        $tid_err = "Indtast et positiv tal";
    } else{
        $tid = $input_tid;
    }
    
    // Check input errors before inserting in database
    if(empty($navn_err) && empty($beskrivelse_err) && empty($tid_err) && empty($bøde_err) && empty($kategori_err)) {
        // Prepare an update statement
        $sql = "UPDATE bøder SET navn=?, beskrivelse=?, tid=?, bøde=?, kategori=? WHERE id=?";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssiisi", $param_navn, $param_beskrivelse, $param_tid, $param_bøde, $param_kategori, $param_id);
            
            // Set parameters
            $param_id = $id;
            $param_tid = $tid;
            $param_bøde = $bøde;
            $param_navn = $navn;
            $param_beskrivelse = $beskrivelse;
            $param_kategori = $kategori;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records updated successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
} else{
    // Check existence of id parameter before processing further
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        // Get URL parameter
        $id =  trim($_GET["id"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM bøder WHERE id = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            
            // Set parameters
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    /* Fetch result row as an associative array. Since the result set contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    // Retrieve individual field value
                    $id = $row["id"];
                    $tid = $row["tid"];
                    $bøde = $row["bøde"];
                    $navn = $row["navn"];
                    $beskrivelse = $row["beskrivelse"];
                    $kategori = $row["kategori"];
                } else{
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: error.php");
                    exit();
                }
                
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
        
        // Close connection
        mysqli_close($link);
    }  else{
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
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
        .wrapper{
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
                        <h2>Update Record</h2>
                    </div>
                    <p>Please edit the input values and submit to update the record.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group <?php echo (!empty($navn_err)) ? 'has-error' : ''; ?>">
                            <label>Navn</label>
                            <input type="text" name="navn" class="form-control" value="<?php echo $navn; ?>">
                            <span class="help-block"><?php echo $navn_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($beskrivelse_err)) ? 'has-error' : ''; ?>">
                            <label>Beskrivelse</label>
                            <textarea name="beskrivelse" class="form-control"><?php echo $beskrivelse; ?></textarea>
                            <span class="help-block"><?php echo $beskrivelse_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($tid_err)) ? 'has-error' : ''; ?>">
                            <label>Tid</label>
                            <input type="text" name="tid" class="form-control" value="<?php echo $tid; ?>">
                            <span class="help-block"><?php echo $tid_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($bøde_err)) ? 'has-error' : ''; ?>">
                            <label>Bøde</label>
                            <input type="text" name="bøde" class="form-control" value="<?php echo $bøde; ?>">
                            <span class="help-block"><?php echo $bøde_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($kategori_err)) ? 'has-error' : ''; ?>">
                            <label>Kategori</label>
                            <input type="text" name="kategori" class="form-control" value="<?php echo $kategori; ?>">
                            <span class="help-block"><?php echo $kategori_err;?></span>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>