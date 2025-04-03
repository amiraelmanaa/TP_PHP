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

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        form {
            max-width: 400px;
            margin: auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin-bottom: 8px;
        }
        button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            border-radius: 5px;
        }
        </style>


</head>
<body>
    <form action="register.php" method="post" >
     
            <label for="name" >Nom d'utilisateur</label>
            <input type="text"  id="name" name="name" required>

            <label for="email" >Email</label>
            <input type="email"  id="email" name="email" required>

            

            <label for="role" >role</label>
            <input type="text"  id="role" name="role" required>

        
            <label for="password" >Mot de passe</label>
            <input type="password"  id="password" name="password" required>
      
        <button type="submit" name="submit" >S'inscrire</button>
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