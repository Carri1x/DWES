<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insertar Coche</title>
</head>
<body>
<form action="/add/revision" method="POST">
    <label for="nombre">Nombre de la revisión: </label>
    <input type="text" name="nombre" placeholder="Introduce el nombre de la revisión">

    <label for="precio">Precio pagado: </label>
    <input type="text" name="precio" placeholder="Introduce el precio pagado">

    <label for="marca">Matrícula del coche: </label>
    <input type="text" name="marca" placeholder=">Introduce la matrícula del coche">

    <input type="submit" value="Guardar Datos">
</form>

</body>
</html>
