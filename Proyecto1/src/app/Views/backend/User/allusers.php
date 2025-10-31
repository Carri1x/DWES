<?php
$titulo = 'Listado de usuarios';
include_once DIRECTORIO_TEMPLATE_BACKEND.'head.php';
include_once DIRECTORIO_TEMPLATE_BACKEND.'header.php';
include_once DIRECTORIO_TEMPLATE_BACKEND.'aside.php';
include_once DIRECTORIO_TEMPLATE_BACKEND.'main.php';

?>
<?php
foreach ($usuarios as $usuario){
?>
    <div class="card-body">
        <form action="/user/<?=$usuario->getUuid()?>/edit">
            <h2 class="card-title"><?=$usuario->getUsername()?></h2>
            <p><?=$usuario->getEmail()?></p>
            <p><?=$usuario->getTipo()->name?></p>
            <input type="text" value="<?=$usuario->getUuid()?>" name="uuid" hidden="hidden">
            <input type="submit" class="btn btn-primary" value="Editar usuario">
        </form>
    </div>
<?php
}
?>

<script>

    let body = document.getElementsByName('body');
    let uuidUsuario;
    body.addEventListener('click',(event)=>{
        uuidUsuario = event.target.previousElementSibling.value;
        if(uuidUsuario){

        }
    })

    const enviarIdParaEditarUsuario = () => {
        const myHeaders = new Headers();
        myHeaders.append("Content-Type", "application/x-www-form-urlencoded");

        const urlencoded = new URLSearchParams();
        urlencoded.append("uuid", "1");

        const requestOptions = {
            method: "PUT",
            headers: myHeaders,
            body: urlencoded,
            redirect: "follow"
        };

        fetch(`http://localhost:8080/user/${uuidUsuario}`, requestOptions)
            .then((response) => response.text())
            .then((result) => console.log(result))
            .catch((error) => console.error(error));
    }
</script>
<?php
include_once DIRECTORIO_TEMPLATE_BACKEND.'footer.php';
?>