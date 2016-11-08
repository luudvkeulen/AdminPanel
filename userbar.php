<div class="row">
    <header>
        <div class="col-md-7">
            <nav class="navbar-default pull-left">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="offcanvas"
                            data-target="#side-menu" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
            </nav>
        </div>
        <div class="col-md-5">
            <div class="header-rightside">
                <ul class="list-inline header-top pull-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img class="avatar" src="<?php echo $steamdetails['avatar'] ?>" alt="user">
                            <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <div class="navbar-content">
                                    <span><?php echo $steamdetails['personaname'] ?></span>
                                    <div class="divider">
                                    </div>
                                    <?php
                                    if (isset($_GET['logout'])) {
                                        logOut();
                                    }

                                    function logOut()
                                    {
                                        unset($_SESSION['user']);
                                        echo '<script type="text/javascript">window.location.href = "index.php";</script>';
                                        //header('Location: index.php');
                                    }

                                    ?>
                                    <a href="?logout=1" class="view btn-sm active">Logout</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </header>
</div>