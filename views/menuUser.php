<?php
    $user = $data["userData"];
    echo "<div id='panelmod'>";
        echo "<h1>BIENVENID@ ".$user[0]->nombre."</h1>";
        echo "<table border=1>";
            
            echo "<tr>";
                echo "<th>Modificar</th>";
                echo "<th>Usuario</th>";
                echo "<th>Nombre</th>";
                echo "<th>Apellidos</th>";
                echo "<th>Email</th>";
                echo "<th>Tipo</th>";
            echo "</tr>";
            echo "<tr>";
                echo "<td><a href='index.php?opc=formModifyUser&usr=".$user[0]->id."'><img src='images/modificar.png' alt='fotomodificar' width='20' height='20'/></a></td>";
                echo "<td>".$user[0]->username."</td>";
                echo "<td>".$user[0]->nombre."</td>";
                echo "<td>".$user[0]->apellidos."</td>";
                echo "<td>".$user[0]->email."</td>";
                if($user[0]->tipo == 0):
                    echo "<td>Administrador</td>";
                else:
                    echo "<td>Usuario</td>";
                endif;
            echo "</tr>";
        echo "</table>";

    echo "<input type='button' name='eliminar' value='Eliminar cuenta' onclick='window.location.href=\"index.php?opc=deleteOwnUser&usr=".$user[0]->id."\"' />";
    ?>