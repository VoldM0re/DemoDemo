<?php
$host = 'localhost';
$dbname = 'demo28';
$dbuser = 'root';
$dbpwd = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $dbuser, $dbpwd);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Не удалось подключиться к БД:<br>' . $e->getMessage());
}