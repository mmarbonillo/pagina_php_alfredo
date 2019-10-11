<!doctype html>
<html>

<head>
    <title>Titulo</title>
    <meta charset="utf-8">
    <meta name="author" content="Maria Del Mar Fernandez Bonillo">

    <link rel="stylesheet" href="style.css">

</head>

<body>
    <div id="todo">
        <div id="formularios">
            <div id="formulariologin">
                <form action="index.php" method="POST">
                    <div class="opcion">
                        <div class="etiqueta">
                            <label for="username">Usuario: </label>
                        </div>
                        <div class="campo">
                            <input type="text" name="username" />
                        </div>
                    </div>
                    <div class="opcion">
                        <div class="etiqueta">
                            <label for="passwd">Contraseña: </label>
                        </div>
                        <div class="campo">
                            <input type="password" name="passwd" />
                        </div>
                    </div>
                    <br>
                    <?php
                    if ($data["mensaje"] != null) {
                        echo "<div style='color:red'>".$data["mensaje"]."</div>";
                    }
                    ?>
                    <br>
                    <input type="submit" name="comprobar" value="Comprobar" />
                    <input type="hidden" name="opc" value='processLogin'>
                </form>
            </div>
            <div id="formularioregistro">
                <form action="index.php" method="POST">
                    <div class="opcion">
                        <div class="etiqueta">
                            <label for="username">Usuario: </label>
                        </div>
                        <div class="campo">
                            <input type="text" name="username" />
                        </div>
                    </div>
                    <div class="opcion">
                        <div class="etiqueta">
                            <label for="nombre">Nombre: </label>
                        </div>
                        <div class="campo">
                            <input type="text" name="name" />
                        </div>
                    </div>
                    <div class="opcion">
                        <div class="etiqueta">
                            <label for="apellidos">Apellidos: </label>
                        </div>
                        <div class="campo">
                            <input type="text" name="surnames" />
                        </div>
                    </div>
                    <div class="opcion">
                        <div class="etiqueta">
                            <label for="passwd">Contraseña: </label>
                        </div>
                        <div class="campo">
                            <input type="password" name="passwd" />
                        </div>
                    </div>
                    <div class="opcion">
                        <div class="etiqueta">
                            <label for="passwd2">Confirmar contraseña: </label>
                        </div>
                        <div class="campo">
                            <input type="password" name="passwd2" />
                        </div>
                    </div>
                    <div class="opcion">
                        <div class="etiqueta">
                            <label for="passwd">Email: </label>
                        </div>
                        <div class="campo">
                            <input type="text" name="email" />
                        </div>
                    </div>
                    <br>
                    <input type="submit" name="registrar" value="Registrarse" />
                    <input type="hidden" name="opc" value='processSignIn'>
                </form>
            </div>
        </div>
    </div>
</body>