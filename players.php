<?php
require('sessioncheck.php');
require('steamauth/steaminfo.php');
require('database/takidatabasefunctions.php');
$steamdetails = getSteamDetails($_SESSION['user']);
?>
<!DOCTYPE html>
<html lang="en-US">

<head>
    <?php include 'head.php' ?>
    <link href="css/players.css" rel="stylesheet">
</head>

<body class="home">
<div class="container-fluid display-table">
    <div class="row display-table-row">
        <?php
        $activepage = 'players';
        include 'navbar.php';
        ?>
        <div class="col-md-10 col-sm-11 display-table-cell v-align">
            <!--<button type="button" class="slide-toggle">Slide Toggle</button> -->
            <?php include 'userbar.php'; ?>
            <div class="user-dashboard">
                <h1>Hello, <?php echo $steamdetails['personaname']; ?></h1>
                <div class="row">
                    <div class="col-md-12">
                        <?php if (isset($_GET['id'])) {
                            include 'playerinfo.php';
                        } else {
                            include 'playerlist.php';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/adminpanel.js"></script>
</body>

</html>
