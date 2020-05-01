<?php
$currentPage = "reports";

include "lib/config.php";

session_start();
ob_start();

// Check if the user is logged in, if not the redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("Location: login.php");
    exit;
}

$sql = "SELECT * FROM reports";
$result = $link->query($sql);
if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        $name = $row["name"];
        $cpr = $row["cprnr"];
        $charges = $row["charges"];
        $penalty = $row["penalty"];
        $seized = $row["seized"];
        $incident = $row["incident"];
        $recognizing = $row["recognizing"];
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>NoRegrets Politi | Kriminalregister</title>
    <meta charset="utf-8">
    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- Custom Styles -->
    <script src="https://kit.fontawesome.com/a771545788.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assests/css/style.css">
</head>

<body>
    <?php include "lib/nav.php" ?>
    <section class="page-section">
        <div class="container">
            <input class="form-control mb-4" id="tableSearch" type="text" placeholder="Søg..." onkeyup="search()">
            <table class="table table-bordered table-striped" id="reportTable">
                <thead>
                    <tr>
                        <th>Navn</th>
                        <th>CPR-NR</th>
                        <th>Oprettet</th>
                        <th>Handling</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM reports";
                    $result = $link->query($sql);
                    if($result->num_rows > 0) {
                        // Output data of each row
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["name"] . "</td>";
                            echo "<td>" . $row["cprnr"] . "</td>";
                            echo "<td>" . $row["created_at"] . "</td>";
                            echo "<td>";
                            echo "<button type='button' class='actions btn btn-primary' data-toggle='modal' data-target='#showModal'>Vis</button>";
                            echo "<a href='editReport.php?id=". $row["id"] ."' class='btn btn-warning'>Rediger</a>";
                            if($_SESSION["role"] == "Admin") {
                                echo "<a href='deleteReport.php? id=". $row['id'] . "' class='btn btn-danger'>Slet</a>";
                            }
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "0 results";
                    }
                    ?>
                </tbody>
            </table>
            <a href="createReport.php" class="btn btn-success pull-right">Opret sag</a>
        </div>
    </section>

    <!-- Vis sag modal -->
    <div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="showModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="showModalLabel"><?php echo "$name - $cpr"?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="chargesInput">Sigtelser</label>
                            <input type="text" class="form-control" id="chargesInput" placeholder="Sigtelser"
                                value="<?php echo $charges?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="penaltyInput">Straf</label>
                            <input type="text" class="form-control" id="penaltyInput" placeholder="Straf"
                                value="<?php echo $penalty?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="seizedInput">Beslaglagte ting</label>
                            <input type="text" class="form-control" id="seizedInput" placeholder="Beslaglagte ting"
                                value="<?php echo $seized?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="incidentTextarea">Hændelse</label>
                            <textarea class="form-control" id="incidentTextarea" rows="3"
                                readonly><?php echo $incident?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="recognizingInput">Erkender</label>
                            <input type="text" class="form-control" id="recognizingInput" placeholder="Erkender" value="<?php echo $recognizing?>" readonly>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Luk</button>
                </div>
            </div>
        </div>
    </div>
    <?php include "lib/footer.php" ?>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
    <script src="assests/js/search.js"></script>
</body>

</html>