<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau des Étudiants</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        table {
            width: 100%;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        img {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 5px;
        }
        .table-container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>

<div class="container">
    <h1 class="mb-4">Liste des Étudiants</h1>

    <!-- Filtering Input -->
    <input type="text" id="searchInput" class="form-control mb-3" placeholder="Rechercher par nom...">

    <div class="table-container">
        <table id="studentsTable" class="display nowrap table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Nom</th>
                    <th>Date de Naissance</th>
                    <th>Section</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
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

            $requete = "SELECT * FROM student";
            $response = $cnxex4->query($requete);

            while ($row = $response->fetch()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                echo "<td><img src='" . htmlspecialchars($row['image']) . "' alt='Photo'></td>";
                echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                echo "<td>" . htmlspecialchars($row['birthday']) . "</td>";
                echo "<td>" . htmlspecialchars(affichenomsection($row['section'], $cnxex4)) . "</td>";
                echo "<td>
                        <a href='detailEtudiant.php?id=" . $row['id'] . "' class='text-info me-2'><i class='bi bi-info-circle-fill'></i></a>
                        <a href='editStudent.php?id=" . $row['id'] . "' class='text-warning me-2'><i class='bi bi-pencil-fill'></i></a>
                        <a href='deleteStudent.php?id=" . $row['id'] . "' class='text-danger'><i class='bi bi-trash-fill'></i></a>
                      </td>";
                echo "</tr>";
            }
            ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    $(document).ready(function () {
        var table = $('#studentsTable').DataTable({
            dom: 'Bfrtip',
            buttons: ['copy', 'excel', 'csv', 'pdf']
        });
        $('#searchInput').on('keyup', function () {
            table.search(this.value).draw();
        });
    });
</script>

</body>
</html>
