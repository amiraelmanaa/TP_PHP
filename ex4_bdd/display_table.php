<?php
try {
    $cnxPDO=new PDO('mysql:host=localhost;port=3307;dbname=ex4','root','');
    $cnxPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $cnxPDO->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
    die();
}
$request="select * from student";
$reponse=$cnxPDO->query($request);
$students=$reponse->fetchAll(PDO::FETCH_ASSOC);//fetch assoc yrjaa disctionaire w ena kont hatitou request tekhou edeka or que request hia fetch obj donc not same type 
//var_dump($reponse);//object(PDOStatement)#2 (1) { ["queryString"]=> string(21) "select * from student" } array(2) { [0]=> array(3) { ["id"]=> int(1) ["nom"]=> string(11) "islem briki" ["date"]=> string(10) "2004-10-11" } [1]=> array(3) {
//var_dump($students);//["id"]=> int(2) ["nom"]=> string(13) "aziza garbâa" ["date"]=> string(10) "2004-06-02" } }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Table</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
<nav class="navbar bg-body-tertiary">
  <div class="container-fluid" style="background-color:rgb(141, 171, 215);">
    <span class="navbar-brand mb-0 h1" style="text-align: center;">List of students</span>
  </div>
</nav>
<table  class="table table-striped">
  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">name</th>
      <th scope="col">Birthday</th>
      <th scope="col">Detail</th>
    </tr>
  </thead>
  <tbody>
    <?php
    foreach ($students as $row) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['id']) . "</td>";
        echo "<td>" . htmlspecialchars($row['nom']) . "</td>";
        echo "<td>" . htmlspecialchars($row['date']) . "</td>";
        echo "<td><a href='detail.php?id=" . htmlspecialchars($row['id']) . "'>ℹ️</a></td>";
        
        echo "</tr>";
    }
    ?>
  </tbody>
</table>

</body>
