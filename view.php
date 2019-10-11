<?php
    class View {
        public static function show($viewName, $data=null) {
            echo '<link rel="stylesheet" href="style.css">';
            //include("views/header.php");
            include("views/$viewName.php");
            if(Security::isSessionOpen()):
                include("views/footer.php");
            endif;
        }

        public static function redirect($actionName, $data=null) {
            $url = "<script>location.href='index.php?opc=$actionName";
            if ($data != null) {
                foreach ($data as $clave=>$valor) {
                    $url = $url . "&" . $clave . "=" . $valor;
                }
            }
            $url = $url . "'</script>";
            echo $url;
        }
    }