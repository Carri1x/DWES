<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todos los coches</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            padding: 20px;
        }

        div {
            background: white;
            padding: 15px;
            margin-bottom: 12px;
            border-radius: 6px;
            border: 1px solid #ddd;
        }

        p {
            margin: 4px 0;
            font-size: 14px;
        }

        div:hover {
            background: #fafafa;
            border-color: #bbb;
        }

    </style>
</head>
<body>
<?php
    if(count($coches) === 0){
        ?>
        <p>No hay coches guardados en la base de datos.</p>
        <?php
    }
foreach ($coches as $coche): ?>
    <div>
        <p>Marca: <?= htmlspecialchars($coche->getMarca()) ?></p>
        <p>Usuario: <?= htmlspecialchars($coche->getUsuario()) ?></p>
        <button class="delete-btn" data-uuid="<?= htmlspecialchars($coche->getUuid()) ?>">Eliminar coche</button>
    </div>
<?php endforeach; ?>

<script>
    // Seleccionamos todos los botones que tengan la clase 'delete-btn'
    const botones = document.querySelectorAll('.delete-btn');

    botones.forEach(boton => {
        boton.addEventListener('click', (evento) => {
            // Obtenemos el UUID directamente del atributo data-uuid
            const uuid = evento.target.dataset.uuid;

            const requestOptions = {
                method: "DELETE",
                redirect: "follow"
            };

            fetch(`http://localhost:8080/delete/coche/${uuid}`, requestOptions)
                .then((response) => response.text())
                .then((result) => {
                    console.log(result);
                    // Opcional: Recarga la página para mostrar el estado actualizado
                    window.location.reload();
                })
                .catch((error) => console.error("Error en la petición FETCH:", error));
        });
    });
</script>
</body>

</html>
