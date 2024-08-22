<?php
$db = "restaurante_2";
$user = "root";
$pass = "";

try{
    $PDO = new PDO("mysql: host=localhost; dbname=". $db, $user, $pass);
} catch (PDOException $erro) {
    echo "ERROR: " .  $erro->getMessage();
    exit;
}