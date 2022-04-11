<?php
session_start();
session_destroy();
// Redirect to the login page:
header('Location: ../output_files/index.php');
?>
