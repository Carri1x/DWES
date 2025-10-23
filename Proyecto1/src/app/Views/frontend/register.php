<?php
echo __DIR__;
$titulo = "Registro";
include_once  DIRECTORIO_TEMPLATE_FRONTEND."head.php";
include_once  DIRECTORIO_TEMPLATE_FRONTEND."header.php";
?>

<form action="/user/register" method="post">
    <label for="registerNombre">Inserta el Nombre</label>
    <input type="text" id="registerNombre" name="nombre" placeholder="Nombre"><br>
    <label for="registerEmail">Inserta el Email</label>
    <input type="email" id="registerEmail" name="email" placeholder="Email"><br>
    <label for="registerPassword">Inserta la Contraseña</label>
    <input type="password" id="registerPassword" name="password" placeholder="Contraseña"><br>
    <input type="submit" value="Registrarme">
</form>

<?php
include_once  DIRECTORIO_TEMPLATE_FRONTEND."footer.php";
?>