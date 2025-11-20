<?php
$titulo = 'Editar Usuario';
include_once DIRECTORIO_TEMPLATE_BACKEND.'head.php';
include_once DIRECTORIO_TEMPLATE_BACKEND.'header.php';
include_once DIRECTORIO_TEMPLATE_BACKEND.'aside.php';
include_once DIRECTORIO_TEMPLATE_BACKEND.'main.php';
?>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6">
            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">
                        <i class="bi bi-person-lines-fill me-2"></i>Editar usuario
                    </h4>
                </div>

                <div class="card-body">
                    <form>
                        <div class="mb-3">
                            <label for="username" class="form-label fw-semibold">Nombre de usuario</label>
                            <input
                                    type="text"
                                    class="form-control"
                                    id="username"
                                    name="username"
                                    value="<?=$usuario->getUsername()?>"
                                    placeholder="Introduce el nombre de usuario"
                            >
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold">Correo electrónico</label>
                            <input
                                    type="email"
                                    class="form-control"
                                    id="email"
                                    name="email"
                                    value="<?=$usuario->getEmail()?>"
                                    placeholder="usuario@correo.com"
                            >
                        </div>

                        <div class="mb-3">
                            <label for="edad" class="form-label fw-semibold">Edad</label>
                            <input
                                    type="number"
                                    class="form-control"
                                    id="edad"
                                    name="edad"
                                    value="<?=$usuario->getEdad()?>"
                                    placeholder="Introduce la edad"
                            >
                        </div>

                        <div class="mb-3">
                            <label for="tipo" class="form-label fw-semibold">Tipo de usuario</label>
                            <select class="form-select" id="tipo" name="tipo">
                                <?php foreach ($tipos as $tipo) { ?>
                                    <option value="<?=$tipo?>"
                                            <?= ($usuario->getTipo()->name == $tipo) ? 'selected' : '' ?>>
                                        <?=$tipo?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <a href="/users" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left"></i> Volver
                            </a>
                            <button id="boton-guardar-cambios" type="submit" class="btn btn-success">
                                <i class="bi bi-save"></i> Guardar cambios
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!--TODO: Aquí es donde tengo que hacer la petición put para modificar al usuario.-->
<script type="module">

    document.getElementById('boton-guardar-cambios').addEventListener('click', (evento) => {
        evento.preventDefault();
        const myHeaders = new Headers();
        myHeaders.append("Content-Type", "application/json");

        const raw = JSON.stringify({
            username: document.getElementById("username").value,
            email: document.getElementById("email").value,
            edad: document.getElementById("edad").value,
            tipo: document.getElementById("tipo").value
        });

        const requestOptions = {
            method: "PUT",
            headers: myHeaders,
            body: raw,
            redirect: "follow"
        };

        fetch("http://localhost:8080/user/<?=$usuario->getUuid()?>", requestOptions)
            .then((response) => response.text())
            .then((result) => {
                console.log(result);
                window.location.href = '/users';
            })
            .catch((error) => {
                    console.error(error);
                    document.body.innerHTML += error;
            });
    });

</script>
<?php
include_once DIRECTORIO_TEMPLATE_BACKEND.'footer.php';

