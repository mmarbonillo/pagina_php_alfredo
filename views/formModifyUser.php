<?php
    $user = $data["userData"];
?>
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
        <form action="index.php?opc=processModifyUser" method="POST">
            <div class="opcion">
                <div class="etiqueta">
                    <label for="username" >Usuario: </label>
                </div>
                <div class="campo">
                    <input type="text" name="username" value="<?php echo $user[0]->username?>"/>
                </div>
            </div>
            <div class="opcion">
                <div class="etiqueta">
                    <label for="nombre" >Nombre: </label>
                </div>
                <div class="campo">
                    <input type="text" name="name" value="<?php echo $user[0]->nombre?>"/>
                </div>
            </div>
            <div class="opcion">
                <div class="etiqueta">
                    <label for="apellidos" >Apellidos: </label>
                </div>
                <div class="campo">
                    <input type="text" name="surnames" value="<?php echo $user[0]->apellidos?>"/>
                </div>
            </div>
            <div class="opcion">
                <div class="etiqueta">
                    <label for="passwd" >Contraseña: </label>
                </div>
                <div class="campo">
                    <input type="text" name="passwd" value="<?php echo $user[0]->passwd?>"/>
                </div>
            </div>
            <div class="opcion">
                <div class="etiqueta">
                    <label for="email" >Email: </label>
                </div>
                <div class="campo">
                    <input type="text" name="email" value="<?php echo $user[0]->email?>"/>
                </div>
            </div>
            <?php
                if($user[0]->tipo == 0):
                    echo "<div class=\"opcion\">
                            <div class=\"etiqueta\">
                                <label for=\"tipo\" >Tipo: </label>
                            </div>
                            <div class=\"campo\">
                                <select id=\"tipo\" name=\"type\">
                                    <option value=\"1\">Usuario</option>
                                    <option value=\"0\" selected=\"selected\">Administrador</option>
                                </select>
                            </div>
                        </div>";
                else:
                    echo "<input type='hidden' name='type' value='".$user[0]->tipo."'>";
                endif;

            ?>
            
            <br>
            <input type="submit" name="guardar" value="Guardar"/>

            <?php echo "<input type='hidden' name='usr' value='".$user[0]->id."'>"; ?>
            <input type="button" name="volver" value="Volver" onclick="window.location.href='index.php?opc=mainMenu'"/>
        </form>
    </div>
</body>
</html>