<?php
require_once 'config.php';
try {
    $conn = new PDO(DB, USER, PWD);
} catch (PDOException $e) {
    die ("Failed: " . $e);
}

$res = $conn->query(file_get_contents("CleanDB.sql"));




echo "réussite :)";
$res = $conn->query('KILL CONNECTION_ID()');
if (!$res) die("Failed query: " );
$conn = null;
