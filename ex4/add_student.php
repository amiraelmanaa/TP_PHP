<?php
$host = "sql7.freesqldatabase.com";
$dbname = "sql7771121";
$username = "sql7771121";
$password = "7MpCGHJkUT";
$port = "3306";

try {
    $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4";
    $cnxex4 = new PDO($dsn, $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
$sectionQuery = "SELECT * FROM section";
$sections = $cnxex4->query($sectionQuery)->fetchAll();
if (isset($_POST['add'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $birthday = $_POST['birthday'];
    $section = $_POST['section'];
    $image = $_POST['image'];

    $query = "INSERT INTO student (id, name, birthday, section, image) VALUES (:id, :name, :birthday, :section, :image)";
    $stmt = $cnxex4->prepare($query);
    $stmt->execute([
        'id' => $id,
        'name' => $name,
        'birthday' => $birthday,
        'section' => $section,
        'image' => $image
    ]);

    header("Location: ex4.php"); // Redirect back to student list
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Add New Student</h2>
    <form method="POST">
        <div class="mb-3">
            <label class="form-label">ID:</label>
            <input type="text" class="form-control" name="id" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Name:</label>
            <input type="text" class="form-control" name="name" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Birthdate:</label>
            <input type="date" class="form-control" name="birthday" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Section:</label>
            <select class="form-control" name="section" required>
                <?php foreach ($sections as $section): ?>
                    <option value="<?= $section['id'] ?>">
                        <?= htmlspecialchars($section['designation']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Image URL:</label>
            <input type="text" class="form-control" name="image" required>
        </div>
        <button type="submit" name="add" class="btn btn-success">Add Student</button>
        <a href="ex4.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</body>
</html>
