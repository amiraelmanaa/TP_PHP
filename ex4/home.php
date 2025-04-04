<?php
require_once('auth.php');
include "user.php"; 
?>
<?php
if (isset($_GET['page'])) {
    if ($_GET['page'] == 'students') {
        header("Location: ex4.php");
        exit();
    } elseif ($_GET['page'] == 'sections') {
        header("Location: listesections.php");
        exit();
    } elseif ($_GET['page'] == 'home') {
        header("Location: home.php");
        exit();
    }
    elseif ($_GET['page'] == 'logout') {
    session_unset();
    session_destroy();
    header("Location: loginpage.php?message=You+have+been+logged+out+successfully");
    exit();
    }
}

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    



    <title>Gestion Étudiants</title>
    <style>
        body {
            background: linear-gradient(to right, #d8e3ff, #f8d7da);
        }
        .navbar {
            background-color: rgb(31, 138, 214) !important;
        }
        .welcome-box {
            text-align: center;
            padding: 40px;
            background: white;
            border-radius: 15px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }
        .dropdown {
            margin-right: 2%;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        

        <a class="navbar-brand fw-bold" href="#" >📚 Student Management</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="?page=home">🏠 Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?page=students">📋 Student List</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?page=sections">📚 Section List</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?page=logout">🚪 Logout</a>
                </li>
            </ul>
        </div>
    </div>




    <div class="dropdown" >
    <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
       id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false" >
        <i class="bi bi-person-circle fs-1" ></i>
    </a>
    <ul class="dropdown-menu dropdown-menu-end text-small shadow" aria-labelledby="dropdownUser1" >
        <li class="dropdown-header" >
            👤 <strong><?php
            
            $user=new user('','');
            $user->afficher_user($cnx,$_SESSION['user_cin']);
            echo $user->getName();
            
            ?></strong><br>
            📧 <?php echo $user->getemail(); ?>
            <?php
             
            if ($user->getrole() == 'admin'){ ?>
                  
                <br><i class="bi bi-shield-lock fs-5"></i> 
                <?php
                echo  " Admin"; }
                else{
                    ?>
                    <br><i class="bi bi-person-check"></i>
                    <?php
                echo "User";
                }
            ?>
        </li>
        <li ><hr class="dropdown-divider"></li>
        <li>
    <form action="modifier_user.php" method="POST">
        <button type="submit" class="dropdown-item" name="modifier_user" value="1"><i class="bi bi-pen"></i> Edit</button>
    </form>
</li>

        
        <li>
    <form action="delete_user.php" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');">
        <button type="submit" class="dropdown-item text-danger" name="delete_user" value="1">🚪 Delete</button>
    </form>
</li>



    </ul>
</div>



</nav>
<div class="container">
    <div class="welcome-box">
        <h1 class="text-primary fw-bold">👋 Hello PHP lovers, Welcome to Your Administration Platform!</h1>
        <p class="lead">Manage students and sections with ease.</p>
        <hr>
        <p class="text-muted">Stay organized, efficient, and productive. 🚀</p>
    </div>
</div>

</body>
</html>
