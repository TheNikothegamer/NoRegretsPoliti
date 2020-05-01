<?php

// Initialize the session
session_start();

// Check if the user is already logged in, if yes the redirect him to welcome page
/* if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true && $_SESSION["role"] === "admin") {
    header("location: calculator.php");
    exit;
} */

// Include config file
require_once "../lib/crud.php";
 
// Define variables and initialize with empty values
$navn = $beskrivelse = $tid = $bøde = $kategori = "";
$navn_err = $beskrivelse_err = $tid_err = $bøde_err = $kategori_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate navn
    $input_navn = trim($_POST["navn"]);
    if(empty($input_navn)){
        $navn_err = "Venligst indtast navn på bøde.";
    } else{
        $navn = $input_navn;
    }
    
    // Validate beskrivelse
    $input_beskrivelse = trim($_POST["beskrivelse"]);
    if(empty($input_beskrivelse)){
        $beskrivelse_err = "Venligst indtast en beskrivelse.";     
    } else{
        $beskrivelse = $input_beskrivelse;
    }

    // Validate bøde
    $input_bøde = trim($_POST["bøde"]);
    if(empty($input_bøde)) {
        $bøde_err = "Venligst indtast beløb.";
    } else {
        $bøde = $input_bøde;
    }

    // Validate kategori
    $input_kategori = trim($_POST["kategori"]);
    if(empty($input_kategori)) {
        $kategori_err = "Venligst indtast en kategori.";
    } else {
        $kategori = $input_kategori;
    }
    
    // Validate tid
    $input_tid = trim($_POST["tid"]);
    if(empty($input_tid)){
        $tid_err = "Indtast tid bøden skal være på.";     
    } elseif(!ctype_digit($input_tid)){
        $tid_err = "Venligst indtast et positiv tal.";
    } else{
        $tid = $input_tid;
    }
    
    // Check input errors before inserting in database
    if(empty($navn_err) && empty($beskrivelse_err) && empty($bøde_err) && empty($kategori_err) && empty($tid)){
        // Prepare an insert statement
        $sql = "INSERT INTO bøder (navn, beskrivelse, bøde, kategori, tid) VALUES (:navn, :beskrivelse, :bøde, :kategori, :tid)";

        if($stmt = $pdo->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":navn", $param_navn);
            $stmt->bindParam(":beskrivelse", $param_beskrivelse);
            $stmt->bindParam(":bøde", $param_bøde);
            $stmt->bindParam(":kategori", $param_kategori);
            $stmt->bindParam(":tid", $param_tid);

            // Set parameters
            $param_navn = $navn;
            $param_beskrivelse = $beskrivelse;
            $param_bøde = $bøde;
            $param_kategori = $kategori;
            $param_tid = $tid;

            // Attempt to execute the prepared statement
            if($stmt->execute()) {
                // Record created successfully. Redirect to landing page
                header("Location: calculator.php");
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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
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
                        <h2>Create Record</h2>
                    </div>
                    <p>Please fill this form and submit to add employee record to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
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
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>