<div class="sales report">
    <h2>Players</h2>
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
            $result = getPlayerCount();
            $pages = ceil((int)$result / 25);
            for ($i = 1; $i <= $pages; $i++) {
                echo '<a href="?page=' . $i . '">' . $i . '</a>';
            }
            ?>
        </div>
    </div>
</div>
<div class="resultdiv">
    <div class="col-md-4"><b>Steamid64</b></div>
    <div class="col-md-4"><b>Name</b></div>
    <div class="col-md-4"><b>Aliases</b></div>
</div>
<?php
if (isset($_GET['page'])) {
    $page = $_GET['page'];
    $limit = ((ceil((int)$page * 25)) - 25);
    $result = getPlayers($limit);
} else {
    $result = getPlayers(0);
}
foreach ($result as $login) {
    echo '<a class="playerrow" href="players.php?id=' . $login['pid'] . '" >';
    echo '<div class="resultdiv">';
    echo '<div class="col-md-4">' . $login['pid'] . '</div>';
    echo '<div class="col-md-4">' . $login['name'] . '</div>';
    $aliases = $login['aliases'];
    echo '<div class="col-md-4">' . substr($aliases, 2, (strlen($aliases) - 4)) . '</div>';
    echo '</div>';
    echo '</a>';
}
?>