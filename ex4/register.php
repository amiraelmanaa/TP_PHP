<?php
require "user.php";
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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #d8e3ff, #f8d7da);
            margin: 0;
            padding: 20px;
        }
        </style>
</head>
<body>
<div class="register-container">
    <h2 class="text-center">📝 Inscription</h2>
    <form action="register.php" method="post">
        <div class="mb-3">
            <label for="name" class="icon-label"><i class="bi bi-person"></i> Nom d'utilisateur</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>

        <div class="mb-3">
            <label for="email" class="icon-label"><i class="bi bi-envelope"></i> Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>

        <div class="mb-3">
            <label for="role" class="icon-label"><i class="bi bi-person-badge"></i> Rôle</label>
            <input type="text" class="form-control" id="role" name="role" required>
        </div>

        <div class="mb-3">
            <label for="password" class="icon-label"><i class="bi bi-lock"></i> Mot de passe</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>

        <button type="submit" name="submit" class="btn btn-primary">S'inscrire</button>
    </form>

    <?php      
    $username = $_POST['name'] ?? '';
    $password = $_POST['password'] ?? '';
    $email = $_POST['email'] ?? '';
    $role = $_POST['role'] ?? '';
    if (isset($_POST['submit'])) {
        $user = new user($email,$password);    
        $user->setName($username);
        $user->setrole($role);
        $user->ajouter_user($cnx);
        echo "<p>Inscription réussie !</p>";
    }
     ?>
</body>
</html>