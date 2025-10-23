<html>
    <head>
        <title>Iniciar sesión</title>
    </head>
    <body>
        <h1>Bienvenido a Netflix</h1>
        <form action="/user/login" method="post" >
            <label for="inputUsername">Nombre de usuario</label>
            <input type="text" id="inputUsername" name="username" placeholder="Introduce tu nombre de usuario." aria-label="Input de username" />

            <label for="inputPassword">Introduce tu contraseña</label>
            <input type="password" id="inputPassword" name="password" placeholder="Introduce tu contraseña" aria-label="Input de password" />

            <input type="submit" value="Iniciar Sesión" />
        </form>
    </body>
</html>
