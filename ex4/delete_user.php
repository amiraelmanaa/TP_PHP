<?php
include "user.php";
session_start();

$host = "sql7.freesqldatabase.com";
$dbname = "sql7771121";
$username = "sql7771121";
$password = "7MpCGHJkUT";
$port = "3306";
try {
    $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4";
    $cnx = new PDO($dsn, $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
$user=new user('','');
$user->afficher_user($cnx,$_SESSION['user_cin']);
$user->supprimer_user($cnx);

session_unset();
session_destroy();
header("Location: loginpage.php?");
?>