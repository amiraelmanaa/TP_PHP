<?php
spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});

session_start();
//bouton effacer
if (isset($_POST['clear'])) {
    session_unset(); 
    session_destroy(); 
    header("Location: test.php"); 
    exit();
}


if (!isset($_SESSION['etudiants'])) {
    $_SESSION['etudiants'] = [
        new Etudiant("Aymen", ["Math" => 11, "Physics" => 13, "Web" => 18, "teleinfo" => 13, "Anglais" => 10, "Francais" => 7, "droits" => 2, "algebre" => 5, "chimie" => 1]),
        new Etudiant("Skander", ["Math" => 15, "Physics" => 9, "Web" => 8, "teleinfo" => 16])
    ];
}


$etudiants = $_SESSION['etudiants'];
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calcul Moyenne des etudiants</title>
    <style>

        #one {
            background-color: rgb(60, 149, 223);
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
        }

        #one:hover {
            background-color: rgb(4, 37, 99);
            color: white;
        }
        #two {
            background-color: rgb(60, 149, 223);
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
        }

        #two:hover {
            background-color: rgb(207, 18, 18);
            color: white;
        }


        body {
            background-color: rgb(197, 194, 194);
            text-align: center;
        }

        h1 {
            background-color: #cfd8dc;
            padding: 10px;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <form action="test.php" method="post">
        <button name="afficher" id="one" type="submit">afficher les notes des etudiants</button>
        <button name="clear" id="two" type="submit" >Effacer</button>
    </form>
    <?php

    if (isset($_POST['afficher'])) {
        foreach ($etudiants as $etudiant) {
            echo "<h3>" . $etudiant->getNom() . "</h3>";
            echo "<ul>";
            foreach ($etudiant->getNotes() as $matiere => $note) {
                $color = $note < 10 ? 'red' : ($note > 10 ? 'green' : 'orange');
                echo "<li style='color:white; background-color:$color; padding:5px; margin:5px; display:inline-block;'>$matiere : $note</li>";
            }
            echo "</ul>";
            echo "<p>Moyenne : " . $etudiant->calculMoyenne(). "</p>";
            echo "<p>Resultat: " . ($etudiant->admis() ? "ADMIS" : "NON ADMIS") . "</p>";
            echo "<hr>";
        }
    }
    ?>

</body>

</html>