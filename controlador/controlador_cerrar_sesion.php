<?php
session_start();
session_destroy();
header("location:/asistenciaUAB/vista/login/login.php");
?>