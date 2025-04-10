<?php
require_once('auth.php');
?>
<?php
$host = "sql7.freesqldatabase.com";
$dbname = "sql7772406";
$username = "sql7772406";
$password = "yF7kWEAscw";
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

if (isset($_GET['export'])) {
    $format = $_GET['export'];
    $requete = "SELECT * FROM section";
    $response = $cnxex4->query($requete);
    $sections = $response->fetchAll();

    if ($format == "csv") {
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=sections.csv');
        $output = fopen('php://output', 'w');
        fputcsv($output, ['ID', 'Designation']);
        foreach ($sections as $row) {
            fputcsv($output, [$row['id'], $row['designation']]);
        }
        fclose($output);
        exit();
    }

    elseif ($format == "excel") {
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=sections.xls");

        echo "ID\tDesignation\n";
        foreach ($sections as $row) {
            echo "{$row['id']}\t{$row['designation']}\n";
        }
        exit();
    }

    elseif ($format == "pdf") {
        header("Content-type: application/pdf");
        header("Content-Disposition: attachment; filename=sections.pdf");

        echo "%PDF-1.3\n";
        echo "1 0 obj\n";
        echo "<< /Type /Catalog /Pages 2 0 R >>\n";
        echo "endobj\n";
        echo "2 0 obj\n";
        echo "<< /Type /Pages /Kids [3 0 R] /Count 1 >>\n";
        echo "endobj\n";
        echo "3 0 obj\n";
        echo "<< /Type /Page /Parent 2 0 R /MediaBox [0 0 612 792]\n";
        echo "/Contents 4 0 R >>\n";
        echo "endobj\n";
        echo "4 0 obj\n";
        echo "<< /Length 55 >>\n";
        echo "stream\n";
        echo "BT /F1 24 Tf 100 700 Td (Sections List) Tj ET\n";
        foreach ($sections as $row) {
            echo "BT /F1 12 Tf 100 680 Td ({$row['id']} - {$row['designation']}) Tj ET\n";
        }
        echo "endstream\n";
        echo "endobj\n";
        echo "xref\n";
        echo "0 5\n";
        echo "0000000000 65535 f \n";
        echo "0000000010 00000 n \n";
        echo "0000000079 00000 n \n";
        echo "0000000176 00000 n \n";
        echo "0000000275 00000 n \n";
        echo "trailer\n";
        echo "<< /Size 5 /Root 1 0 R >>\n";
        echo "startxref\n";
        echo "377\n";
        echo "%%EOF\n";
        exit();
    }
}
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
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Section List</title>
    <style>
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
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
                    <a class="nav-link " href="?page=home">🏠 Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?page=students">📋 Student List</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="?page=sections">📚 Section List</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?page=logout">🚪 Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
    <div class="container mt-4">
        <h1>Section List</h1>

        <!-- Export Buttons -->
        <div class="mb-3">
            <a href="?export=csv" class="btn btn-success btn-sm">Export to CSV</a>
            <a href="?export=excel" class="btn btn-info btn-sm">Export to Excel</a>
            <a href="?export=pdf" class="btn btn-danger btn-sm">Export to PDF</a>
        </div>

        <!-- Table of Sections -->
        <table class="table table-bordered">
            <tr>
                <th>ID</th>
                <th>Designation</th>
                <th>Action</th>
            </tr>
            <?php
            // Fetch all sections
            $requete = "SELECT * FROM section";
            $response = $cnxex4->query($requete);
            while ($row = $response->fetch()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                echo "<td>" . htmlspecialchars($row['designation']) . "</td>";
                echo "<td>
                        <form method='POST' action=''>
                            <input type='hidden' name='selected_section' value='" . htmlspecialchars($row['id']) . "'>
                            <button type='submit' class='btn btn-primary btn-sm'>Voir étudiants</button>
                        </form>
                      </td>";
                echo "</tr>";
            }
            ?>
        </table>

        <?php
        // If a section is selected, fetch and display students in that section
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['selected_section'])) {
            $sectionId = $_POST['selected_section'];

            // Fetch students from the selected section
            $req = "SELECT * FROM student WHERE section = :section";
            $stmt = $cnxex4->prepare($req);
            $stmt->execute(['section' => $sectionId]);
            $students = $stmt->fetchAll();

            if (count($students) > 0) {
                echo "<h3 class='mt-4'>Étudiants dans cette section :</h3>";
                echo "<div class='row'>";
                foreach ($students as $student) {
                    echo "<div class='col-md-4 mb-3'>";
                    echo "<div class='card'>";
                    echo "<img src='" . htmlspecialchars($student['image']) . "' class='card-img-top' alt='Photo'>";
                    echo "<div class='card-body'>";
                    echo "<h5 class='card-title'>" . htmlspecialchars($student['name']) . "</h5>";
                    echo "<p class='card-text'><strong>ID:</strong> " . htmlspecialchars($student['id']) . "</p>";
                    echo "<p class='card-text'><strong>Date de Naissance:</strong> " . htmlspecialchars($student['birthday']) . "</p>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                }
                echo "</div>";
            } else {
                echo "<p class='text-muted'>Aucun étudiant trouvé dans cette section.</p>";
            }
        }
        ?>

    </div>
</body>
</html>
