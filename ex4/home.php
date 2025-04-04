<?php
require_once('auth.php');
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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="#">📚 Student Management</a>
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
</nav>
<div class="container">
    <div class="welcome-box">
        <h1 class="text-primary fw-bold">👋 Hello PHP lovers, Welcome to Your Administration Platform!</h1>
        <p class="lead">Manage students and sections with ease.</p>
        <hr>
        <p class="text-muted">Stay organized, efficient, and productive. 🚀</p>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
