<?php 
session_start();
unset($_SESSION['usuario']);
unset($_SESSION['favoritos']);
session_destroy();
header('Location: /index.php');
exit();