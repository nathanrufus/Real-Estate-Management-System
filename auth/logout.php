<?php
session_start();
session_unset();
session_destroy();
header("Location: /Real-Estate-Management-System/index.php");
?>
