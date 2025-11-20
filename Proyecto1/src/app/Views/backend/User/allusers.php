<?php
$titulo = 'Listado de usuarios';
include_once DIRECTORIO_TEMPLATE_BACKEND . 'head.php';
include_once DIRECTORIO_TEMPLATE_BACKEND . 'header.php';
include_once DIRECTORIO_TEMPLATE_BACKEND . 'aside.php';
include_once DIRECTORIO_TEMPLATE_BACKEND . 'main.php';

?>
    <div class="container mt-4">
        <div class="row g-4">
            <?php foreach ($usuarios as $usuario) { ?>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="card shadow-sm h-100">
                        <div class="card-body d-flex flex-column justify-content-between">
                            <div>
                                <h5 class="card-title text-capitalize mb-1">
                                    <?= htmlspecialchars($usuario->getUsername()) ?>
                                </h5>
                                <p class="card-text text-muted mb-1"><?= htmlspecialchars($usuario->getEmail()) ?></p>
                                <span class="badge bg-primary"><?= htmlspecialchars($usuario->getTipo()->name) ?></span>
                            </div>
                            <form action="/user/<?= $usuario->getUuid() ?>" method="GET">
                                <button type="submit" class="btn btn-outline-primary w-100">
                                    Editar usuario
                                </button>
                            </form>

                            <button class="boton-eliminar-usuario">
                                Eliminar usuario
                            </button> <!-- TODO: Aquí tengo que eliminar el usuario en el CONTROLLER (no está hecho) -->

                            <input type="text" hidden="hidden" value="<?= $usuario->getUuid() ?>"/>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <script type="module">
        window.onload = () => {
            const botones = document.getElementsByClassName('boton-eliminar-usuario');
            for (const boton of botones) {
                boton.addEventListener('click', (evento) => {
                    const inputUuid = evento.target.nextElementSibling;
                    const nombreUsuario = evento.target.parentElement.firstElementChild.firstElementChild.textContent;
                    if (!confirm(`Estas seguro que quieres eliminar a ${nombreUsuario}`)) return; //Si no quiere eliminarlo sale del evento.

                    const requestOptions = {
                        method: "DELETE",
                        redirect: "follow"
                    };

                    fetch(`http://localhost:8080/user/${inputUuid.value}`, requestOptions)
                        .then((response) => response.text())
                        .then((result) => {
                            console.log(result);
                            pintarMensaje(result);
                            evento.target.parentElement.parentElement.remove(); //Eliminamos la tarjeta y su contenido.
                        })
                        .catch((error) => console.error(error));
                });

            }

            const pintarMensaje = (mensaje) => {
                const contenedorMensaje = document.createElement('div');

                contenedorMensaje.id = 'contenedor-mensaje';
                contenedorMensaje.innerHTML = `<p style="color: #0099ff">${mensaje}</p>`;

                contenedorMensaje.style.cssText = `
        background-color: lightgray;
        border: 1px solid gray;
        padding: 10px;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 1000; /* Recomendado para mensajes */
        display: flex;
        justify-content: center;
        align-items: center;
        align-content: center;
    `;

                document.body.appendChild(contenedorMensaje);

                setTimeout(() => {

                    contenedorMensaje.remove();
                }, 3000);
            };
        } // FIN DEL WINDOW ONLOAD


    </script>
<?php
include_once DIRECTORIO_TEMPLATE_BACKEND . 'footer.php';
?>