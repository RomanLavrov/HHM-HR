<?php

define('DB_SERVER', 'hhmeweme.mysql.db.hostpoint.ch');
define('DB_USERNAME', 'hhmeweme_trehub');
define('DB_PASSWORD', 'NjGhGR4C');
define('DB_NAME', 'hhmeweme_hrDev');

try {
    $pdo = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD, null);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("ERROR: Could not connect. " . $e->getMessage());
}
