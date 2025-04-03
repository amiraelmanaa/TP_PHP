<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau des Étudiants</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
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
    </style>
</head>
<body>

    <h1>Liste des Étudiants</h1>

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

    // Fonction sécurisée pour récupérer le nom de la section
    function affichenomsection($sectionid, $cnxex4) {
        $req = "SELECT designation FROM section WHERE id = :id";
        $stmt = $cnxex4->prepare($req);
        $stmt->execute(['id' => $sectionid]);
        $row = $stmt->fetch();
        return $row ? $row['designation'] : "Inconnue";
    }

    $requete = "SELECT * FROM student";
    $response = $cnxex4->query($requete);

    echo "<table>";
    echo "<tr><th>ID</th><th>Nom</th><th>Date de Naissance</th><th>Section</th><th>Image</th> <th> action</th></tr>"; 

    while ($row = $response->fetch()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['id']) . "</td>"; 
        echo "<td>" . htmlspecialchars($row['name']) . "</td>"; 
        echo "<td>" . htmlspecialchars($row['birthday']) . "</td>"; 
        echo "<td>" . htmlspecialchars(affichenomsection($row['section'], $cnxex4)) . "</td>";
        echo "<td><img src='" . htmlspecialchars($row['image']) . "' alt='Photo'></td>";
        echo "<td><a href='détailEtudiant.php?id=" . $row['id'] . "' class='link-info link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover'><i class='bi bi-info-circle-fill'></i></a></td>";
        echo "</tr>";
    }

    echo "</table>";
    ?>

</body>
</html>
