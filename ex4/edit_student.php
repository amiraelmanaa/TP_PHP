<?php
require_once('auth.php');
?>
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

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM student WHERE id = :id";
    $stmt = $cnxex4->prepare($query);
    $stmt->execute(['id' => $id]);
    $student = $stmt->fetch();
    if (!$student) {
        die("Student not found.");
    }
    $sectionQuery = "SELECT * FROM section";
    $sections = $cnxex4->query($sectionQuery)->fetchAll();
}

// Update student info
if (isset($_POST['update'])) {
    $id_old = $_POST['id_old'];
    $id_new = $_POST['id'];
    $name = $_POST['name'];
    $birthday = $_POST['birthday'];
    $section = $_POST['section'];
    $image = $_POST['image'];

    $query = "UPDATE student SET id = :id_new, name = :name, birthday = :birthday, section = :section, image = :image WHERE id = :id_old";
    $stmt = $cnxex4->prepare($query);
    $stmt->execute([
        'id_new' => $id_new,
        'name' => $name,
        'birthday' => $birthday,
        'section' => $section,
        'image' => $image,
        'id_old' => $id_old
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
    <title>Edit Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Edit Student</h2>
    <form method="POST">
        <input type="hidden" name="id_old" value="<?= htmlspecialchars($student['id']) ?>">
        <div class="mb-3">
            <label class="form-label">ID:</label>
            <input type="text" class="form-control" name="id" value="<?= htmlspecialchars($student['id']) ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Name:</label>
            <input type="text" class="form-control" name="name" value="<?= htmlspecialchars($student['name']) ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Birthdate:</label>
            <input type="date" class="form-control" name="birthday" value="<?= htmlspecialchars($student['birthday']) ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Section:</label>
            <select class="form-control" name="section" required>
                <?php foreach ($sections as $section): ?>
                    <option value="<?= $section['id'] ?>" <?= ($section['id'] == $student['section']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($section['designation']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Image URL:</label>
            <input type="text" class="form-control" name="image" value="<?= htmlspecialchars($student['image']) ?>" required>
        </div>
        <button type="submit" name="update" class="btn btn-primary">Update</button>
        <a href="ex4.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</body>
</html>
