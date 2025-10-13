<?php

$titulo = 'PasswordGenerator';
include_once './views/template/head.php';
include_once  './views/template/header.php';
?>
    <div class="row">
        <div class="col">
<?php
    include_once  './views/template/sidebar.php';
?>
        </div>
        <div class="col">
            <h1>Tu contraseña es: <?=$password?> </h1>
        </div>
    </div>
<?php
include_once './views/template/footer.php';

