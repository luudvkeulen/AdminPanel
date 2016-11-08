<?php

require_once ($_SERVER['DOCUMENT_ROOT'] . '/steamauth/steaminfo.php');

function formatLicenses($string)
{
    $licenses = str_replace("],", "]*", $string);
    $licenses = explode("*", substr($licenses, 2, strlen($licenses) - 4));
    $output = "";
    $count = 0;
    foreach ($licenses as $license) {
        if (preg_match("/\\w*,1/", $license)) {
            $strippedlicense = str_replace(["`", "[", "]", ",1"], "", $license);
            $output = $output . $strippedlicense . "<br/>";
            $count = $count + 1;
        }
    }
    if ($count == 0) {
        echo "none";
    } else {
        echo $output;
    }
}

function formatGear($string)
{
    $gear = explode(",", substr($string, 2, strlen($string) - 4));
    $output = "";
    $count = 0;
    $gear = str_replace(["`", "[", "]"], "", $gear);
    $gear = array_count_values($gear);
    foreach ($gear as $item => $amount) {
        if ($item != '``' && $item != '') {
            if ($amount > 1) {
                $output = $output . $item . ' : <span class="amounttext">' . $amount . "</span><br/>";
            } else {
                $output = $output . $item . "<br/>";
            }
            $count = $count + 1;
        }
    }
    if ($count == 0) {
        echo "none";
    } else {
        echo $output;
    }
}

$player = getPlayerInfo($_GET['id']);
if (count($player) < 1) {
    echo 'This user does not exist';
} else {
    $player = $player[0]; ?>
    <div class="playerinfo steaminfo">
        <div class="row">
            <div class="steamimage pull-left">
                <?php
                $user = getSteamDetails($_GET['id']);
                echo '<img src="' . $user['avatarfull'] . '"/>';
                ?>
            </div>
            <div class="steamname">
                <?php
                echo '<b>Steam information</b><br/>';
                echo '<b>Steam name:</b> ' . $user['personaname'] . '<br/>';
                echo '<b>Steam url:</b> <a target="_blank" href="' . $user['profileurl'] . '">' . $user['profileurl'] . '</a></br>';
                if($user['personastate'] == 0) {
                    echo '<b>Status:</b> <span class="red">Offline/Private profile</span></br>';
                } else if ($user['personastate'] > 1 && $user['personastate'] < 5) {
                    echo '<b>Status:</b> <span class="orange">Busy/Away/Snooze</span></br>';
                } else {
                    echo '<b>Status:</b> <span class="green">Online</span></br>';
                }
                echo '<b>Last seen:</b> ' . gmdate("H:i d/m/Y",$user['lastlogoff']);
                ?>
            </div>
        </div>
    </div>
    <div class="playerinfo">
        <div class="row">
            <div class="col-md-2 text-right"><b>pid</b></div>
            <div class="col-md-5 borderleft"><?php echo $player['pid'] ?></div>
        </div>
        <div class="row">
            <div class="col-md-2 text-right"><b>name</b></div>
            <div class="col-md-5 borderleft"><?php echo $player['name'] ?></div>
        </div>
        <div class="row">
            <div class="col-md-2 text-right"><b>aliases</b></div>
            <div class="col-md-5 borderleft">
                <?php
                $aliases = explode(",", substr($player['aliases'], 2, strlen($player['aliases']) - 4));

                foreach ($aliases as $alias) {
                    echo str_replace("`", "", $alias) . "<br/>";
                }
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2 text-right"><b>cash</b></div>
            <div class="col-md-5 borderleft"><?php echo $player['cash'] ?></div>
        </div>
        <div class="row">
            <div class="col-md-2 text-right"><b>bank</b></div>
            <div class="col-md-5 borderleft"><?php echo $player['bankacc'] ?></div>
        </div>
        <div class="row">
            <div class="col-md-2 text-right"><b>Police level</b></div>
            <div class="col-md-5 borderleft"><?php echo $player['coplevel'] ?></div>
        </div>
        <div class="row">
            <div class="col-md-2 text-right"><b>Medic level</b></div>
            <div class="col-md-5 borderleft"><?php echo $player['mediclevel'] ?></div>
        </div>
        <div class="row">
            <div class="col-md-2 text-right"><b>Military level</b></div>
            <div class="col-md-5 borderleft"><?php echo $player['millevel'] ?></div>
        </div>
        <div class="row">
            <div class="col-md-2 text-right"><b>Civillian licenses</b></div>
            <div class="col-md-5 borderleft">
                <?php
                echo formatLicenses($player['civ_licenses']);
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2 text-right"><b>Police licenses</b></div>
            <div class="col-md-5 borderleft">
                <?php echo formatLicenses($player['cop_licenses']); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2 text-right"><b>Medic licenses</b></div>
            <div class="col-md-5 borderleft"><?php echo formatLicenses($player['med_licenses']) ?></div>
        </div>
        <div class="row">
            <div class="col-md-2 text-right"><b>Military licenses</b></div>
            <div class="col-md-5 borderleft"><?php echo formatLicenses($player['mil_licenses']) ?></div>
        </div>
        <div class="row">
            <div class="col-md-2 text-right"><b>Civillian gear</b></div>
            <div class="col-md-5 borderleft"><?php echo formatGear($player['civ_gear']) ?></div>
        </div>
        <div class="row">
            <div class="col-md-2 text-right"><b>Police gear</b></div>
            <div class="col-md-5 borderleft"><?php echo formatGear($player['cop_gear']) ?></div>
        </div>
        <div class="row">
            <div class="col-md-2 text-right"><b>Medic gear</b></div>
            <div class="col-md-5 borderleft"><?php echo formatGear($player['med_gear']) ?></div>
        </div>
        <div class="row">
            <div class="col-md-2 text-right"><b>Military gear</b></div>
            <div class="col-md-5 borderleft"><?php echo formatGear($player['mil_gear']) ?></div>
        </div>
        <div class="row">
            <div class="col-md-2 text-right"><b>adminlevel</b></div>
            <div class="col-md-5 borderleft"><?php echo $player['adminlevel'] ?></div>
        </div>
        <div class="row">
            <div class="col-md-2 text-right"><b>donatorlevel</b></div>
            <div class="col-md-5 borderleft"><?php echo $player['donatorlvl'] ?></div>
        </div>
        <div class="row">
            <div class="col-md-2 text-right"><b>Joined on</b></div>
            <div class="col-md-5 borderleft"><?php echo $player['insert_time'] ?></div>
        </div>
        <div class="row">
            <div class="col-md-2 text-right"><b>Last seen</b></div>
            <div class="col-md-5 borderleft"><?php echo $player['last_seen'] ?></div>
        </div>
    </div>
<?php } ?>