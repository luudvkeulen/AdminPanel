<?php
if(!isset($_SESSION))
{
    session_start();
}

function loginbutton()
{
    $button = "<a href='?login'><img src='pictures/steamlogin.png'></a>";

    echo $button;
}

if (isset($_GET['login'])) {
    require $_SERVER['DOCUMENT_ROOT'] . '/openid/openid.php';
    try {
        require 'steamconfig.php';
        $openid = new LightOpenID($steamauth['domainname']);

        if (!$openid->mode) {
            $openid->identity = 'http://steamcommunity.com/openid';
            header('Location: ' . $openid->authUrl());
        } elseif ($openid->mode == 'cancel') {
            echo 'User has canceled authentication!';
        } else {
            if ($openid->validate()) {
                $id = $openid->identity;
                $ptn = '/^http:\/\/steamcommunity\.com\/openid\/id\/(7[0-9]{15,25}+)$/';
                preg_match($ptn, $id, $matches);

                require ($_SERVER['DOCUMENT_ROOT'] . '/database/database.php');

                $stmt = $conn->prepare('SELECT * FROM users WHERE pid = ?');
                $stmt->execute([$matches[1]]);
                $user = $stmt->fetch();

                if(count($user) > 1) {
                    $_SESSION['user'] = $user[0];
                    $stmt = $conn->prepare('INSERT INTO logins (pid, success, ip) VALUES (?, \'1\', ?);');
                    $stmt->execute([$user[0], $_SERVER['REMOTE_ADDR']]);
                } else {
                    $stmt = $conn->prepare('INSERT INTO logins (pid, success, ip) VALUES (?, \'0\', ?);');
                    $stmt->execute([$matches[1], $_SERVER['REMOTE_ADDR']]);
                }
                $conn = null;

                if (!headers_sent()) {
                    header('Location: ' . $steamauth['loginpage']);
                    exit;
                } else {
                    ?>
                    <script type="text/javascript">
                        window.location.href = "<?=$steamauth['loginpage']?>";
                    </script>
                    <noscript>
                        <meta http-equiv="refresh" content="0;url=<?= $steamauth['loginpage'] ?>"/>
                    </noscript>
                    <?php
                    exit;
                }
            }
        }
    } catch (ErrorException $e) {
        //echo $e->getMessage();
    }
}