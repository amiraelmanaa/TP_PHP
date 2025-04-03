<?php
require_once "session.php";
$session = new SessionManager();
$session->incrementVisitCount();
$visitCount = $session->getVisitCount();
$message = ($visitCount == 1) 
    ? "Bienvenue à notre plateforme." 
    : "Merci pour votre fidélité, c'est votre {$visitCount}ème visite.";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Sessions</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <div class="alert alert-info text-center">
        <h2><?= $message; ?></h2>
        <?php echo "Session ID: " . session_id();?>

    </div>
    <form method="post">
        <button type="submit" name="reset" class="btn btn-danger">Réinitialiser la session</button>
    </form>
    <?php
    if (isset($_POST['reset'])) {
        $session->resetSession();
    }
    ?>
</body>
</html>
