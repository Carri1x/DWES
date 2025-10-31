<?php
$titulo='Editar Usuario';
include_once DIRECTORIO_TEMPLATE_BACKEND.'head.php';
include_once DIRECTORIO_TEMPLATE_BACKEND.'header.php';
include_once DIRECTORIO_TEMPLATE_BACKEND.'aside.php';
include_once DIRECTORIO_TEMPLATE_BACKEND.'main.php';
?>

<div class="card-body">
    <form action="">
        <h1 class="h1 card-title">Editar el usuario: <?=$usuario->getUsername()?></h1>
        <label>Nombre: </label>
        <input type="text" name="username" placeholder="<?=$usuario->getUsername()?>">
        <label>Email: </label>
        <input type="email" name="email" placeholder="<?=$usuario->getEmail()?>">
        <label>Edad: </label>
        <input type="text" name="edad" placeholder="<?=$usuario->getEdad()?>">
        <label>Tipo de usuario: <?=$usuario->getTipo()->name?></label>
        <select name="tipo">+
            <?php //Aquí ponemos opciones del tipo de usuario dinámicamente.
            foreach ($tipos as $tipo) { ?>
            <option value="<?=$tipo?>"><?=$tipo?></option>
            <?php
            }
            ?>
        </select>
    </form>
</div>
<?php
include_once DIRECTORIO_TEMPLATE_BACKEND.'footer.php';