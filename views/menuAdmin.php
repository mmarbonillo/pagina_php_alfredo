<?php
$usersList = $data["usersData"];
$userAdmin = $data["userAdmin"];
    echo "<div id='administracion'>";
        echo "<table border=1 text-align='center'>";
            echo "<h1>BIENVENID@ ".strtoupper($userAdmin->nombre)."</h1>";
            if(isset($data["mensaje"])):
                echo "<div style='color:blue'>".$data["mensaje"]."</div>";
            endif;
            echo "<a href='index.php?opc=formCreateUser'><img src='images/nuevo.png' alt='fotomodificar' width='35' height='35'/></a>Nuevo usuario";
            echo "<tr>";
                echo "<th style='width:80px; align=right'>Eliminar</th>";
                echo "<th style='width:50px'>ID</th>";
                echo "<th style='width:170px'>Usuario</th>";
                echo "<th style='width:170px'>Nombre</th>";
                echo "<th style='width:170px'>Apellidos</th>";
                echo "<th style='width:170px'>Email</th>";
                echo "<th style='width:50px'>Tipo</th>";
                echo "<th style='width:80px'>Modificar</th>";
            echo "</tr>";
            foreach($usersList as $user):
                echo "<tr>";
                    echo "<td><a href='index.php?opc=deleteUser&usr=".$user->id."'><img src='images/delete.png' alt='fotomodificar' width='20' height='20'/></a></td>";
                    echo "<td>".$user->id."</td>";
                    echo "<td>".$user->username."</td>";
                    echo "<td>".$user->nombre."</td>";
                    echo "<td>".$user->apellidos."</td>";
                    echo "<td>".$user->email."</td>";
                    echo "<td>".$user->tipo."</td>";
                    echo "<td><a href='index.php?opc=formModifyUser&usr=".$user->id."'><img src='images/modificar.png' alt='fotomodificar' width='20' height='20'/></a></td>";
                echo "</tr>";
            endforeach;
        echo "</table>";
    echo "</div>";
?>