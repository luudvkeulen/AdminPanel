<?php

require ('database.php');

function getUserCount($steamid) {
    global $conn;
    $stmt = $conn->prepare('SELECT * FROM users WHERE pid = ?');
    $stmt->execute([$steamid]);
    $count = $stmt->rowCount();
    //$conn = null;
    return $count;
}

function getLogins($limit) {
    global $conn;
    $stmt = $conn->prepare('SELECT pid, success, max(`time`) AS `time`, ip FROM adminpanel.logins GROUP BY pid ORDER BY `time` ASC LIMIT :limit,25');
    $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetchAll();
    //$conn = null;
    return $result;
}

function countLogins() {
    global $conn;
    $stmt = $conn->query('SELECT COUNT(DISTINCT(pid)) as logins FROM logins');
    $result = $stmt->fetchAll();
    //$conn = null;
    return $result;
}