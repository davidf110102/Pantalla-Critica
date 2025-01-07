<?php
    session_start();
    $usuario_id = $_SESSION["usuario_id"];
    include_once 'controllers/controler.php';
    include_once 'models/modelo.php';
    $mvc=new MvcController();
    $mvc->plantilla();
?>