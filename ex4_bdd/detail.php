<?php
try {
    $cnxPDO = new PDO('mysql:host=localhost;port=3307;dbname=ex4', 'root', '');
    $cnxPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $cnxPDO->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die('Connection failed: ' . $e->getMessage());
}

// Check if 'id' is set in the URL
if (isset($_GET['id'])) {
    $student_id = $_GET['id'];

    // Prepare and execute query
    $stmt = $cnxPDO->prepare("SELECT * FROM student WHERE id = :id");
    $stmt->execute(['id' => $student_id]);
    $student = $stmt->fetch();
} else {
    $student = false; // No ID provided
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <?php if ($student): ?>
            <div class="card mx-auto" style="width: 22rem;">
                <div class="card-body text-center">
                    <h5 class="card-title">Student Details</h5>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>ID:</strong> <?= htmlspecialchars($student['id']); ?></li>
                    <li class="list-group-item"><strong>Name:</strong> <?= htmlspecialchars($student['nom']); ?></li>
                    <li class="list-group-item"><strong>Birthday:</strong> <?= htmlspecialchars($student['date']); ?></li>
                </ul>
                <div class="card-body text-center">
                    <a href="display_table.php" class="btn btn-primary">Back to List</a>
                </div>
            </div>
        <?php else: ?>
            <div class="alert alert-danger text-center" role="alert">
                Student not found or no ID provided.
            </div>
            <div class="text-center">
                <a href="display_table.php" class="btn btn-secondary">Back to List</a>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
