<?php
session_start();
ob_start();

require_once "lib/config.php";

// Check if the user is logged in, if not the redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("Location: login.php");
    exit;
}

$sql = "SELECT * FROM bøder";
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>NoRegrets Politi | Lommeregner</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <!-- Custom fonts -->
    <script src="https://kit.fontawesome.com/a771545788.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet'
        type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>

    <!-- Calculator files -->
    <script src="assests/Calculator_files/jquery.min.js"></script>
    <script src="assests/Calculator_files/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous">
    </script>
    <script src="assests/Calculator_files/popper.min.js"></script>
    <link rel="stylesheet" href="assests/Calculator_files/style_keyvalue.css">
    <link href="assests/Calculator_files/icon" rel="stylesheet">
    <script src="assests/Calculator_files/script_keyvalue.js"></script>
    <script src="assests/Calculator_files/search.js"></script>
    <!-- <script src="Calculator_files/script_loadtable.js"></script> -->

    <!-- Preloader -->
    <link rel="stylesheet" href="assests/css/style.css">
    <script src="assests/js/preloader.js"></script>
</head>

<body>
    <div class="loader">
        <div class="image">
            <i class="fas fa-codepen"></i>
        </div>
        <span></span>
    </div>
    <div class="content">
    <?php include "lib/nav.php" ?>
    <div class="container">
        <div class="row">
            <div id="myPopup" class="myPopup">Hey!</div>
            <div id="myPopup2" class="myPopup two">Hey!</div>
            <div id="myPopup3" class="myPopup three">Hey!</div>
            <div id="myPopup4" class="myPopup four">Hey!</div>
            <div class="row">
                <script language="javascript">
                    var getDesc = localStorage.getItem('desc');
                    var desc = document.getElementsByClassName('description');
                    var table = document.getElementById('mainTable');
                </script>
                <input class="form-control mb-4" id="tableSearch" type="text" placeholder="Søg...">
                <?php
                    if($result = mysqli_query($link, $sql)) {
                        if(mysqli_num_rows($result) > 0) {
                            echo "<table class='table table-striped table-dark'>";
                            echo "<tbody id='fineTable'>";
                            while ($row = mysqli_fetch_array($result)) {
                                echo "<tr>";
                                echo "<td><a style='color:white;' href='javascript:void(0);' data-toggle='tooltip' data-name='".$row["navn"]."' data-time='".$row["tid"]."' data-fine='".$row["bøde"]."' onclick='addCharge(this)' title='".$row["beskrivelse"]."'>".$row["navn"]."</a></td>";
                                echo "<td>".$row["tid"]."</td>";
                                echo "<td>".$row["bøde"]."</td>";
                                echo "<td>".$row["beskrivelse"]."</td>";
                                echo "</tr>";
                            }
                            echo "</tbody>";
                            echo "</table>";
                        }
                    }
                        ?>
            </div>
        </div>
    </div>

    <div id="crimesTable" class="col-lg-4 theyAllFloat">
                <table class="table table-bordered table-shrink even-four">
                    <tbody>
                        <tr class="headliner-title">
                            <td style="border-left:none;color:white" align="center"><strong>Sigtelser</strong></td>
                        </tr>
                    </tbody>
                </table>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div id="charge-table">
                            <p>Der er ingen sigtelser</p>
                        </div>
                    </div>

                    <div class="panel-footer"><a class="btn btn-primary" href="javascript:void(0);"
                            onclick="copyToClipboard()">Kopier Sigtelser til Clipboard</a>
                    </div>
                </div>
            </div>

    <script language="javascript">
        if (getDesc == '1' || getDesc == null) {
            document.getElementById('btnDescriptions').innerText = 'Gem Beskrivelse';
        } else {
            document.getElementById('btnDescriptions').innerText = 'Vis Beskrivelse';
            for (i = 0; i < desc.length; i++) {
                desc[i].style.display = 'none';
            }
        }
    </script>
    </div>
    <script type="text/javascript">
        $(function () {
            $('[data-toggle="tooltip"]').tooltip({
                trigger: "hover"
            })
        })
    </script>
    </div>
    </div>
</body>

</html>