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
        die($e->getMessage());
    }
    $id = intval($_GET['id']);
    $requete = "SELECT * FROM student where id = :id";
    $stmt = $cnxex4->prepare($requete);
   
    $stmt->bindParam(':id',$id, PDO::PARAM_INT);
    $stmt->execute();
    
    if ($stmt->rowCount() > 0) {
        $student = $stmt->fetch(PDO::FETCH_ASSOC);
    } else {
        echo "<p>Étudiant non trouvé.</p>";
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de l'Étudiant</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
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
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .back-button {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }
        .back-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Détails de l'Étudiant</h1>

        <table>
            <tr>
                <th>ID</th>
                <td><?php echo $student['id']; ?></td>
            </tr>
            <tr>
                <th>Name</th>
                <td><?php echo $student['name']; ?></td>
            </tr>
            <tr>
                <th>Birthday</th>
                <td><?php echo $student['birthday']; ?></td>
            </tr>
    
        </table>

        <a href="ex4.php" class="back-button">Retour à la liste des étudiants</a>
    </div>

</body>
</html>