<?php

define('DB_SERVER', 'hhmeweme.mysql.db.hostpoint.ch');
define('DB_USERNAME', 'hhmeweme_tergu');
define('DB_PASSWORD', 'IraLavrova198');
define('DB_NAME', 'hhmeweme_HR');

try {
    $pdo = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD, null);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("ERROR: Could not connect. " . $e->getMessage());
}
