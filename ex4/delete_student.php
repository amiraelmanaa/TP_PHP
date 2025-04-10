<?php
require_once('auth.php');
?>
<?php
$host = "sql7.freesqldatabase.com";
$dbname = "sql7772406";
$username = "sql7772406";
$password = "yF7kWEAscw";
$port = "3306";

try {
    $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4";
    $cnxex4 = new PDO($dsn, $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "DELETE FROM student WHERE id = :id";
    $stmt = $cnxex4->prepare($query);
    $stmt->execute(['id' => $id]);

    header("Location: ex4.php");
    exit();
}
?>
