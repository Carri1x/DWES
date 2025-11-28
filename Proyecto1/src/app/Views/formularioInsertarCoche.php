<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insertar Coche</title>
</head>
<body>
    <form action="/add/coche" method="POST">
        <label for="marca">Marca del coche: </label>
        <input type="text" name="marca" placeholder="Introduce la marca del coche">

        <label for="usuario">Usuario del coche: </label>
        <input type="text" name="usuario" placeholder="Introduce el nómbre del dueño">

        <input type="submit" value="Guardar Datos">
    </form>

</body>
</html>
