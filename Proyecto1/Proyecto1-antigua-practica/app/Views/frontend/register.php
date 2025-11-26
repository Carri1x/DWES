<?php
$titulo = "Registro";
include_once  DIRECTORIO_TEMPLATE_FRONTEND."head.php";
include_once  DIRECTORIO_TEMPLATE_FRONTEND."header.php";
?>

<form action="/user/register" method="post">
    <label for="registerNombre">Inserta el Nombre</label>
    <input type="text" id="registerNombre" name="username" placeholder="Nombre"><br>
    <label for="registerEmail">Inserta el Email</label>
    <input type="email" id="registerEmail" name="email" placeholder="Email"><br>
    <label for="registerPassword">Inserta la Contraseña</label>
    <input type="password" id="registerPassword" name="password" placeholder="Contraseña"><br>
    <label for="registerEdad">Inserta la edad</label>
    <input type="text" id="registerEdad" name="edad" placeholder="Edad">
    <label for="registerTipo"></label>
    <select id="registerTipo" name="type">
        <option value="normal">Normal</option>
        <option value="anuncios">Anuncios</option>
        <option value="admin">Administrador</option>
    </select>
    <input type="submit" value="Registrarme">
</form>

<?php
include_once  DIRECTORIO_TEMPLATE_FRONTEND."footer.php";
?>