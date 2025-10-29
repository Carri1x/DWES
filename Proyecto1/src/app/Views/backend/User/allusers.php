<?php
$titulo = 'Listado de usuarios';
include_once DIRECTORIO_TEMPLATE_BACKEND.'head.php';
include_once DIRECTORIO_TEMPLATE_BACKEND.'header.php';
include_once DIRECTORIO_TEMPLATE_BACKEND.'aside.php';
include_once DIRECTORIO_TEMPLATE_BACKEND.'main.php';

?>
<?php
foreach ($usuarios as $usuario){
?>
    <div class="card-body">
        <h2 class="card-title"><?=$usuario->getUsername()?></h2>
        <p><?=$usuario->getEmail()?></p>
        <p><?=$usuario->getTipo()->name?></p>
    </div>
<?php
}
include_once DIRECTORIO_TEMPLATE_BACKEND.'footer.php';
?>