<?php
include 'user.php'; 
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

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    if (isset($_POST['email']) && isset($_POST['password']) && !empty($_POST['email']) && !empty($_POST['password'])) {
      
        $user = new user($_POST['email'], $_POST['password']);
        if ($user->login($cnx, $_POST['email'], $_POST['password'])) {
            header("Location: home.php");
            exit();
        } else {
            $error = "Email ou mot de passe incorrect";
        }
    } else {
        $error = "Veuillez remplir tous les champs";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page de Connexion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Connexion</h1>
        <form method="POST" action="">
            <div class="mb-3">
                <label for="email" class="form-label">Email de l'utilisateur</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <?php if (!empty($error)): ?>
                <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>
            <button type="submit" class="btn btn-primary">Se connecter</button>
        </form>

        <div class="mt-3 text-center">
            <a href="register.php">Créer un compte</a>
            




    </div>
</body>
</html>