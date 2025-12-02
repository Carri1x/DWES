<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preferencia</title>
    <style>
        form{
            padding: 10px;
            border: 1px solid black;
        }
    </style>
</head>
<body>
<form action="/add/coche" method="GET">
    <input type="submit" value="Insertar Coche">
</form>
<form action="/add/revision" method="GET">
    <input type="submit" value="Insertar Revisión">
</form>
<form action="/coches" method="GET">
    <input type="submit" value="Mostrar todos los coches">
</form>

</body>
</html>
