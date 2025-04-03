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
    } elseif ($_GET['page'] == 'logout') {
        header("Location: loginpage.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding:0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        img {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 5px;
        }
        .navbar {
            background-color: rgb(31, 138, 214) !important;
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
<h1>Student List</h1>
<div class="d-flex justify-content-between align-items-center my-3">
    <a href="add_student.php" class="btn btn-success">➕ Add Student</a>
    <form method="GET" class="d-flex">
        <input type="text" name="search" class="form-control me-2" placeholder="Search by name..." 
               value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
        <button type="submit" class="btn btn-primary">🔍 Search</button>
        <a href="ex4.php" class="btn btn-secondary ms-2">Reset</a>
    </form>
</div>
<?php
$host = "sql7.freesqldatabase.com";
$dbname = "sql7771121";
$username = "sql7771121";
$password = "7MpCGHJkUT";
$port = "3306";
try {
    $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4";
    $cnxex4 = new PDO($dsn, $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
function affichenomsection($sectionid, $cnxex4) {
    $req = "SELECT designation FROM section WHERE id = :id";
    $stmt = $cnxex4->prepare($req);
    $stmt->execute(['id' => $sectionid]);
    $row = $stmt->fetch();
    return $row ? $row['designation'] : "Inconnue";
}
// Search filter logic
$searchQuery = "";
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $searchQuery = " WHERE name LIKE :search ";
}
$requete = "SELECT * FROM student" . $searchQuery;
$stmt = $cnxex4->prepare($requete);

if ($searchQuery) {
    $stmt->execute(['search' => "%" . $_GET['search'] . "%"]);
} else {
    $stmt->execute();
}
$response = $stmt;
echo "<table>";
echo "<tr><th>ID</th><th>Nom</th><th>Date de Naissance</th><th>Section</th><th>Image</th><th>Actions</th></tr>";
while ($row = $response->fetch()) {
    echo "<tr>";
    echo "<td>" . htmlspecialchars($row['id']) . "</td>"; 
    echo "<td>" . htmlspecialchars($row['name']) . "</td>"; 
    echo "<td>" . htmlspecialchars($row['birthday']) . "</td>"; 
    echo "<td>" . htmlspecialchars(affichenomsection($row['section'], $cnxex4)) . "</td>";
    echo "<td><img src='" . htmlspecialchars($row['image']) . "' alt='Photo'></td>";
    echo "<td>
        <a href='détailEtudiant.php?id=" . $row['id'] . "' class='text-info'><i class='bi bi-info-circle-fill'></i></a>
        <a href='delete_student.php?id=" . $row['id'] . "' class='text-danger' onclick='return confirm(\"Are you sure?\");'><i class='bi bi-trash-fill'></i></a>
        <a href='edit_student.php?id=" . $row['id'] . "' class='text-warning'><i class='bi bi-pencil-fill'></i></a>
    </td>";
    echo "</tr>";
}
echo "</table>";
?>
</body>
</html>
