<?php
    $usersList = $data["usersList"];
    echo "<a href='index.php?do=formCreateUser'>Crear nuevo</a><br>";
    echo "<ul>";
    foreach ($usersList as $user) {
        echo "<li>" . $user->username . " - " . $user->password . " - " . $user->email .
                        " - <a href='index.php?do=formUpdateUser&user=$user->username'>Modificar</a>" .
                        " - <a href='index.php?do=deleteUser&user=$user->username'>Borrar</a></li>";
    }
    echo "<a href='index.php?do=closeSession'>Cerrar sesión</a><br>";
    echo "</ul>";
