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
            <form action="index.php" method="POST">
                <div class="opcion">
                    <div class="etiqueta">
                        <label for="username" >Usuario: </label>
                    </div>
                    <div class="campo">
                        <input type="text" name="username"/>
                    </div>
                </div>
                <div class="opcion">
                    <div class="etiqueta">
                        <label for="nombre" >Nombre: </label>
                    </div>
                    <div class="campo">
                        <input type="text" name="name"/>
                    </div>
                </div>
                <div class="opcion">
                    <div class="etiqueta">
                        <label for="apellidos" >Apellidos: </label>
                    </div>
                    <div class="campo">
                        <input type="text" name="surnames"/>
                    </div>
                </div>
                <div class="opcion">
                    <div class="etiqueta">
                        <label for="passwd" >Contraseña: </label>
                    </div>
                    <div class="campo">
                        <input type="password" name="passwd"/>
                    </div>
                </div>
                <div class="opcion">
                    <div class="etiqueta">
                        <label for="passwd" >Email: </label>
                    </div>
                    <div class="campo">
                        <input type="text" name="email"/>
                    </div>
                </div>
                <div class="opcion">
                    <div class="etiqueta">
                        <label for="tipo" >Tipo: </label>
                    </div>
                    <div class="campo">
                        <select id="tipo" name="type">
                            <option value="1" selected="selected">Usuario</option>
                            <option value="0">Administrador</option>
                        </select>
                    </div>
                </div>
                <br>
                <input type="hidden" name="opc" value="processCreateUser"/>
                <input type="submit" name="insertar" value="Insertar"/>
                <input type='button' name='volver' value='Volver' onclick="window.location.href='index.php?opc=mainMenu'"/>
            </form>
        </div>
    </body>