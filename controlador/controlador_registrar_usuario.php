<?php
include "../modelo/conexion.php";

if (!empty($_POST["btnregistrar"])) {
    if (!empty($_POST["txtnombre"]) and !empty($_POST["txtapellido"]) and !empty($_POST["txtusuario"]) and !empty($_POST["txtpassword"])) {
        $nombre = $_POST["txtnombre"];
        $apellido = $_POST["txtapellido"];
        $usuario = $_POST["txtusuario"];
        $password = md5($_POST["txtpassword"]);

        $sql = $conection->query("SELECT COUNT(*) as 'total' FROM usuario WHERE usuario='$usuario'");
        if ($sql->fetch_object()->total > 0) {
            ?>
            <script>
                $(function notificacion() {
                    new PNotify({
                        title: "ERROR",
                        type: "error",
                        text: "Este usuario <?=$usuario?> ya existe",
                        styling: "bootstrap3"
                    });
                });
            </script>
            <?php
        } else {
            $registro = $conection->query("INSERT INTO usuario(nombre, apellido, usuario, password) VALUES ('$nombre','$apellido','$usuario','$password')");
            if ($registro == true) {
                ?>
                <script>
                    $(function notificacion() {
                        new PNotify({
                            title: "CORRECTO",
                            type: "success",
                            text: "El usuario ha sido registrado correctamente",
                            styling: "bootstrap3"
                        });
                    });
                </script>
                <?php
            } else {
                ?>
                <script>
                    $(function notificacion() {
                        new PNotify({
                            title: "INCORRECTO",
                            type: "error",
                            text: "Error al registrar usuario",
                            styling: "bootstrap3"
                        });
                    });
                </script>
                <?php
            }
        }
    } else {
        ?>
        <script>
            $(function notificacion() {
                new PNotify({
                    title: "ERROR",
                    type: "error",
                    text: "Los campos están vacíos",
                    styling: "bootstrap3"
                });
            });
        </script>
        <?php
    }
    ?>
    <script>
        setTimeout(() => {
            window.history.replaceState(null, null, window.location.pathname);
        }, 0);
    </script>
    <?php
}
?>
