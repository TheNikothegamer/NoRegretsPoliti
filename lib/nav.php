<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="calculator.php">NoRegrets Politi</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="reports.php">KR</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="calculator.php">Lommeregner</a>
            </li>
            <?php
            if($_SESSION["role"] == "Admin") {
            ?>
            <li class="nav-item">
                <a class="nav-link" href="admin/index.php">Admin</a>
            </li>
            <?php
            }
            ?>
            <li class="nav-item">
                <a class="nav-link" href="logout.php">Log Ud</a>
            </li>
            </ul>
        </div>
    </nav>