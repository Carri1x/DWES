<?php
$titulo = 'Crear Usuario';
include_once DIRECTORIO_TEMPLATE_BACKEND.'head.php';
include_once DIRECTORIO_TEMPLATE_BACKEND.'header.php';
include_once DIRECTORIO_TEMPLATE_BACKEND.'aside.php';
include_once DIRECTORIO_TEMPLATE_BACKEND.'main.php';
?>
<div class="card-body">
    <form method="POST" action="/create/user">
        <h1 class="h1 card-title">Crear nuevo usuario</h1>

        <label>Nombre:</label>
        <input type="text" name="username" required class="form-control" placeholder="Introduce un nombre de usuario">

        <label>Contraseña:</label>
        <input type="password" name="password" required class="form-control" placeholder="Introduce una contraseña">

        <label>Email:</label>
        <input type="email" name="email" required class="form-control" placeholder="Introduce el email">

        <label>Edad:</label>
        <input type="number" name="edad" required class="form-control" placeholder="Introduce la edad">

        <label>Tipo de usuario:</label>
        <select name="tipo" class="form-control">
            <?php foreach ($tipos as $tipo): ?>
                <option value="<?= $tipo ?>"><?= $tipo ?></option>
            <?php endforeach; ?>
        </select>

        <br>
        <button type="submit" class="btn btn-primary">Crear Usuario</button>
    </form>
</div>
<?php
include_once DIRECTORIO_TEMPLATE_BACKEND.'footer.php';
