<?php
session_start();

if (!isset($_SESSION['user_cin'])) {
    // Redirect with a message in the query string
    header('Location: loginpage.php?message=Please+log+in+to+access+this+page');
    exit();
}
?>
