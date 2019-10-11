<?php
    if ($data["mensaje"] != null) {
        echo "<div style='color:red'>".$data["mensaje"]."</div>";
    }
?>
    <form action="index.php" method="get">
    	<label for="user">Usuario
	    <input type="text" name="user" value=""></label>
        <label for="password">Contraseña:
        <input type="password" name="password"></label>
        <input type="hidden" name="do" value="processLogin">
        <input type="submit" value="Aceptar">
    </form>
