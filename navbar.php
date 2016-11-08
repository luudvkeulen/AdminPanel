<div class="col-md-2 col-sm-1 hidden-xs display-table-cell v-align box" id="navigation">
    <div class="logo">
        <a hef="home.html"><img src="pictures/nglogo.png" alt="merkery_logo" class="hidden-xs hidden-sm">
            <img src="pictures/nglogo.png" alt="merkery_logo" class="visible-xs visible-sm circle-logo">
        </a>
    </div>
    <div class="navi">
        <ul>
            <li <?php if($activepage == 'home') echo 'class="active"';?>>
                <a href="adminpanel.php">
                    <i class="fa fa-home" aria-hidden="true"></i>
                    <span class="hidden-xs hidden-sm">Home</span>
                </a>
            </li>
            <li <?php if($activepage == 'players') echo 'class="active"';?>>
                <a href="players.php">
                    <i class="fa fa-user" aria-hidden="true"></i>
                    <span class="hidden-xs hidden-sm">Players</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fa fa-tasks" aria-hidden="true"></i>
                    <span class="hidden-xs hidden-sm">Workflow</span></a>
            </li>
            <li>
                <a href="#">
                    <i class="fa fa-bar-chart" aria-hidden="true"></i>
                    <span class="hidden-xs hidden-sm">Statistics</span></a>
            </li>
            <li>
                <a href="#">
                    <i class="fa fa-user" aria-hidden="true"></i>
                    <span class="hidden-xs hidden-sm">Calender</span>
                </a>
            </li>
            <li><a href="#">
                    <i class="fa fa-calendar" aria-hidden="true"></i>
                    <span class="hidden-xs hidden-sm">Users</span>
                </a>
            </li>
            <li><a href="#">
                    <i class="fa fa-cog" aria-hidden="true"></i>
                    <span class="hidden-xs hidden-sm">Setting</span>
                </a>
            </li>
        </ul>
    </div>
</div>