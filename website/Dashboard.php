<!DOCTYPE html>
<html lang="en">

<?php include 'views/Header.php'; ?>

<body>
    <?php include 'views/bar/TopBar.php' ?>

    <div id="dashboard">
        <div class="card shadow">
            <h1>Dashboard</h1>
        </div>
        <?php include 'views/user/UserPanel.php' ?>
        <?php include 'views/bar/FlightBar.php' ?>
    </div>

    <?php include 'views/footer.php' ?>
</body>

</html>