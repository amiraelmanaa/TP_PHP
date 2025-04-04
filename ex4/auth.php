<?php
session_start();

if (!isset($_SESSION['user_cin'])) {
    header('Location: loginpage.php?message=Please+log+in+to+access+this+page');
    exit();
}
?>
