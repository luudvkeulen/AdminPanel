<?php
require('sessioncheck.php');
require('steamauth/steaminfo.php');
require('database/databasefunctions.php');
$steamdetails = getSteamDetails($_SESSION['user']);
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
    <?php include 'head.php' ?>
</head>
<body class="home">
<div class="container-fluid display-table">
    <div class="row display-table-row">
        <?php
        $activepage = 'home';
        include 'navbar.php';
        ?>
        <div class="col-md-10 col-sm-11 display-table-cell v-align">
            <!--<button type="button" class="slide-toggle">Slide Toggle</button> -->
            <?php include 'userbar.php';?>
            <div class="user-dashboard">
                <h1>Hello, <?php echo $steamdetails['personaname'] ?></h1>
                <div class="row">
                    <div class="col-md-12">
                        <div class="sales report">
                            <h2>Login attempts</h2>
                            <div class="btn-group">
                                <button class="btn btn-secondary btn-lg dropdown-toggle" type="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <?php
                                    if (!isset($_GET['page'])) {
                                        echo '<span>Page: 1</span>';
                                    } else {
                                        echo '<span>Page: ' . $_GET['page'] . '</span>';
                                    }
                                    ?>

                                </button>
                                <div class="dropdown-menu pageselect">
                                    <?php
                                    $result = countLogins();
                                    $logins = $result[0][0];
                                    $pages = ceil((int)$result / 25);
                                    for ($i = 1; $i <= $pages; $i++) {
                                        echo '<a href="?page=' . $i . '">' . $i . '</a>';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="resultdiv">
                            <div class="col-md-3"><b>Steamid64</b></div>
                            <div class="col-md-1"><b>Success</b></div>
                            <div class="col-md-3 col-md-offset-1"><b>Time</b></div>
                            <div class="col-md-3 col-md-offset-1"><b>IP Address</b></div>
                        </div>
                        <?php
                        if (isset($_GET['page'])) {
                            $page = $_GET['page'];
                            $limit = ((ceil((int)$page * 25)) - 25);
                            $result = getLogins($limit);
                        } else {
                            $result = getLogins(0);
                        }
                        foreach ($result as $login) {
                            echo '<div class="resultdiv">';
                            echo '<div class="col-md-3">' . $login['pid'] . '</div>';
                            if ($login['success'] == 0) {
                                echo '<div class="col-md-1 text-danger">False</div>';
                            } else {
                                echo '<div class="col-md-1 text-success">True</div>';
                            }

                            echo '<div class="col-md-3 col-md-offset-1">' . $login['time'] . '</div>';
                            echo '<div class="col-md-3 col-md-offset-1">' . $login['ip'] . '</div>';
                            echo '</div>';
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