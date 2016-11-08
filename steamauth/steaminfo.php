<?php
if(!isset($_SESSION))
{
    session_start();
}

function getSteamDetails($steamid) {
    $url = "http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=ED8B7A53F7EBC3393ED7AE3DE0BCC3A2" . "&steamids=" . $steamid;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    $content = json_decode($output, true);
    return $content['response']['players'][0];
}