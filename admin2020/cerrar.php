<?php
session_start();
setcookie('id_usuario', null, -1, '/');
header('Location: index.php');
?>