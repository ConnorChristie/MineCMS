<?php

function clean($string) {
    $new_string = mysql_real_escape_string($string);
    return $new_string;
}

function includeModel($model) {
    if (file_exists('public' . DS . 'models' . DS . $model . ".model.php")) {
        //Include the requested model if it exists.
        include 'public' . DS . 'models' . DS . $model . ".model.php";
    }
}

function SendHttpError($code, $page) {
    switch ($code) {
        case 404:
            header('HTTP/1.0 404 Not found');
            $location = $page;
            include ('errors/404.php');
            $logger = new logger;
            $logger->error($code, $page, time());
            break;
        case 500:
            header('HTTP/1.0 500 Internal Server Error');
            include ('errors/500.html');
    }
}

global $mysql;
$mysql = $config['mysql'];

function dbConnect() {
    global $mysql;
    mysql_connect($mysql['host'], $mysql['username'], $mysql['password']);
    mysql_select_db($mysql['database']);
}

function dbQuery($query) {
    return mysql_query($query);
}

function dbDisconnect() {
    return mysql_close();
}

function dbArray($result) {
    return mysql_fetch_assoc($result);
}

function fileExistsInDB($fname) {
    dbConnect();
    $result = mysql_query("
        SELECT * FROM `files`
        WHERE `name` = '$fname'
        ") or die(mysql_error());
    if (mysql_num_rows($result) > 0)
        return true;
    else
        return false;
}

function randomGen() {
    $time = time();
    $letters = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k');
    $randInt = rand(0, 10);
    $randCha = $letters[$randInt];
    $random = $randCha . $time . $randInt;
    $md5 = md5($random);
    $x = 0;
    while ($randInt > $x) {
        $md5 = md5($md5);
        $x++;
    }
    $md5 = substr($md5, 0, 10);
    return $md5;
}
