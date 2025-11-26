<?php
$titulo = 'Página de inicio';
include_once DIRECTORIO_TEMPLATE_FRONTEND.'head.php';
include_once DIRECTORIO_TEMPLATE_FRONTEND.'header.php';
?>
<h1>Bienvendio a la página de inicio usuario:</h1>
<h2>Uuid: <?=$usuario -> getUuid()?></h2>
<h2>Username: <?=$_SESSION['username']?></h2>
<h2>Gmail: <?=$usuario -> getEmail()?></h2>
<h2>Edad: <?=$usuario->getEdad()?></h2>
<h2>Tipo : <?=$usuario->getTipo()->name?></h2>
<?php
include_once DIRECTORIO_TEMPLATE_FRONTEND.'footer.php';
?>
