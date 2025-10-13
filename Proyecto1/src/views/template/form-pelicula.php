<?php
include_once './views/template/head.php';
include_once './views/template/header.php';
include_once './views/template/sidebar.php';
?>
<h1>Insertar</h1>
<form action="/insertar-pelicula" method="POST">
    <label for="nombre">Nombre: </label>
    <input type="text" id="nombre" placeholder="Matrix" name="nombre">

    <label for="genero">Genero: </label>
    <select id="genero">
        <option value="terror">Terror</option>
        <option value="comedia">Comedia</option>
    </select>
</form>
