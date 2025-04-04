<?php
require "Repository.php";

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
    <title>test</title>
    <style> body {
    font-family: 'Segoe UI', sans-serif;
    background-color: #fdf6f0;
    margin: 0;
    padding: 20px;
    color: #333;
}

h2, h3 {
    color: #5a3e85;
}

form {
    background-color: #ffffff;
    padding: 15px;
    margin-bottom: 30px;
    border: 1px solid #ddd;
    border-radius: 10px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    max-width: 400px;
}

input[type="text"],
input[type="email"],
input[type="date"] {
    width: 100%;
    padding: 8px;
    margin: 6px 0 12px;
    border: 1px solid #ccc;
    border-radius: 8px;
    box-sizing: border-box;
}

button {
    background-color: #a86ee7;
    color: white;
    padding: 10px 16px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: background-color 0.3s;
}

button:hover {
    background-color: #8a54c7;
}

table {
    border-collapse: collapse;
    width: 100%;
    margin-bottom: 30px;
}

table, th, td {
    border: 1px solid #ddd;
}

th {
    background-color: #e8ddfa;
    color: #4a3272;
}

td, th {
    padding: 10px;
    text-align: left;
}

img {
    border-radius: 8px;
}
 </style>
</head>
<body>
    <h1>Testing  Repository class</h1>

    <div name="test_avec_table_users">
        <h2>Testing table users</h2>
        <h3>users list</h3>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
            </tr>
            <?php
        
            $repository = new Repository($cnx, 'users', 'cin', ['username', 'email', 'role']);
            $users = $repository->findAll();
            foreach ($users as $user) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($user['cin']) . "</td>";
                echo "<td>" . htmlspecialchars($user['username']) . "</td>";
                echo "<td>" . htmlspecialchars($user['email']) . "</td>";
                echo "<td>" . htmlspecialchars($user['role']) . "</td>";
                echo "</tr>";
            }
            ?>
        </table>
        <h3>Create a user</h3>
        <form method="POST" >
            <label for="name">Name:</label>
            <input type="text" name="name" required><br>
            <label for="email">Email:</label>
            <input type="email" name="email" required><br>
            <label for="role">Role:</label>
            <input type="text" name="role" required><br>
            <button  name="submit1" type="submit">Create</button>
        </form>
        <?php
        if (isset($_POST['submit1'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $role = $_POST['role'];

            $repository->create(['username' => $name, 'email' => $email, 'role' => $role]);
            echo "<p>User added successefully!</p>";
        }

        ?>
        <h3>Delete a user</h3>
        <form method="POST" action="test.php">
            <label for="cin">ID of the user to delete</label>
            <input  name="cin" required><br>
            <button name="submit2" type="submit">Delete</button>
        </form>
        <?php
        if (isset($_POST['submit2'])) {
            $cin = $_POST['cin'];
            $repository->deleteById($cin);
            echo "<p>Utilisateur supprimé avec succès!</p>";
        }
        ?>
    </div>

    <div>
        <h2>Testing table student</h2>
        <h3>Students list</h3>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Birthday</th>
                <th>Section</th>
                <th>Image</th>
            </tr>
            <?php
            $repository = new Repository($cnx, 'student', 'id', ['name', 'birthday', 'section', 'image']);
            $students = $repository->findAll();
            foreach ($students as $student) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($student['id']) . "</td>";
                echo "<td>" . htmlspecialchars($student['name']) . "</td>";
                echo "<td>" . htmlspecialchars($student['birthday']) . "</td>";
                echo "<td>" . htmlspecialchars($student['section']) . "</td>";
                echo "<td><img src='" . htmlspecialchars($student['image']) . "' alt='Student Image' width='50'></td>";
                echo "</tr>";
            }
            ?>
        </table>
        <h3>Ajouter un etudiant</h3>
        <form method="POST" action="test.php">
            <label for="id">ID:</label>
            <input type="text" name="id" required><br>
            <label for="name">Nom:</label>
            <input type="text" name="name" required><br>
            <label for="birthday">Date de naissance:</label>
            <input type="date" name="birthday" required><br>
            <label for="section">Section:</label>
            <input type="text" name="section" required><br>
            <label for="image">Image URL:</label>
            <input type="text" name="image"><br>
            <button name="submit4" type="submit">Ajouter</button>
        </form>
        <?php
        if (isset($_POST['submit4'])) {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $birthday = $_POST['birthday'];
            $section = $_POST['section'];
            $image = $_POST['image'];

            $repository->create(['id' => $id, 'name' => $name, 'birthday' => $birthday, 'section' => $section, 'image' => $image]);
            echo "<p>Étudiant ajouté avec succès!</p>";
        }
        ?>
        <h3>Supprimer un étudiant</h3>
        <form method="POST" action="test.php">
            <label for="id">ID de l'étudiant à supprimer:</label>
            <input  name="id" required><br>
            <button name="sup" type="submit">Supprimer</button>
        </form>
        <?php
        if (isset($_POST['sup'])) {
            $id = $_POST['id'];
            $repository->deleteById($id);
            echo "<p>Étudiant supprimé avec succès!</p>";
        }
        ?>
        <h3>trouver un etudiant par id</h3>
        <form method="POST" action="test.php">
            <label for="id">ID de l'etudiant a trouver</label>
            <input  name="id" required><br>
            <button name="subid" type="submit">Trouver</button>
        </form>
        <?php
        if (isset($_POST['subid'])) {
            $id = $_POST['id'];
            $student = $repository->findById($id);
            if ($student) {
                echo "<p>etudiant trouvé: " . htmlspecialchars($student['name']) . "</p>";
            } else {
                echo "<p>aucun etudiant trouvé avec cet ID </p>";
            }
        }
        ?>
    </div>

    <div>
        <h2>Test avec la table section</h2>
        <h3>Liste des sections</h3>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Designation</th>
            </tr>
            <?php
            $repository = new Repository($cnx, 'section', 'id', ['designation']);
            $sections = $repository->findAll();
            foreach ($sections as $section) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($section['id']) . "</td>";
                echo "<td>" . htmlspecialchars($section['designation']) . "</td>";
                echo "</tr>";
            }
            ?>
        </table>
        <h3>Ajouter une section</h3>
        <form method="POST" action="test.php">
            <label for="id">ID:</label>
            <input type="text" name="id" required><br>
            <label for="designation">Désignation:</label>
            <input type="text" name="designation" required><br>
            <button name="sub5" type="submit">Ajouter</button>
        </form>
        <?php
        if (isset($_POST['sub5'])) {
            $id = $_POST['id'];
            $designation = $_POST['designation'];

            $repository->create(['id' => $id, 'designation' => $designation]);
            echo "<p>Section ajoutée avec succès!</p>";
        }
        ?>
        <h3>Supprimer une section</h3>
        <form method="POST" action="test.php">
            <label for="id">ID de la section à supprimer:</label>
            <input  name="id" required><br>
            <button name="sub6" type="submit">Supprimer</button>
        </form>
        <?php
        if (isset($_POST['sub6'])) {
            $id = $_POST['id'];
            $repository->deleteById($id);
            echo "<p>Section supprimée avec succès!</p>";
        }
        ?>
        <h3>trouver une section par id</h3>
        <form method="POST" action="test.php">
            <label for="id">ID de la section a trouver</label>
            <input  name="id" required><br>
            <button name="sub7" type="submit">Trouver</button>
        </form>
        <?php
        if (isset($_POST['sub7'])) {
            $id = $_POST['id'];
            $section = $repository->findById($id);
            if ($section) {
                echo "<p>section trouve: " . htmlspecialchars($section['designation']) . "</p>";
            } else {
                echo "<p>aucune section trouve avec cet ID </p>";
            }
        }
        ?>
       
    

    </div>
    
</body>
</html>