<?php
echo "<h2>Crear nuevo usuario</h2>";
if ($data["mensaje"] != null) {
    echo "<div style='color:red'>" . $data["mensaje"] . "</div>";
}
echo "<form action='index.php' method='get'>";
echo "<input type='hidden' name='do' value='createUser'>";
echo "Usuario: <input type='text' name='user'><br>";
echo "Contraseña: <input type='password' name='pass'><br>";
echo "Email: <input type='text' name='email'><br>";
if ($data["userType"] == 0) {   //Usuario de tipo administador
    echo "Tipo: <input type='text' name='tipo'><br>";
}
echo "<input type='submit'>";
echo "</form>";
echo "<a href='index.php?do=mainMenu'>Volver</a>";
