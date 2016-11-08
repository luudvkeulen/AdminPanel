<?php

require ('takidatabase.php');

function getPlayerCount() {
    global $conn;
    $stmt = $conn->query('SELECT COUNT(*) AS amount FROM players;');
    $count = $stmt->fetchAll();
    return $count[0][0];
}

function getPlayers($limit) {
    global $conn;
    $stmt = $conn->prepare('SELECT pid,`name`, aliases FROM players LIMIT :limit,25');
    $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetchAll();
    return $result;
}

function getPlayerInfo($steamid) {
    global $conn;
    $stmt = $conn->prepare('SELECT * FROM players WHERE pid = ?');
    $stmt->execute([$steamid]);
    $result = $stmt->fetchAll();
    return $result;
}