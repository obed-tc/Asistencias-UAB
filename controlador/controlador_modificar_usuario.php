<?php
if (!empty($_POST["btnmodificar"])) {
    if (!empty($_POST["txtnombre"]) and !empty($_POST["txtapellido"]) and !empty($_POST["txtusuario"])){
        $nombre = $_POST["txtnombre"];
        $apellido = $_POST["txtapellido"];
        $usuario = $_POST["txtusuario"];
        $id=$_POST["txtid"];
        $sql = $conection->query(" SELECT COUNT(*) as 'total' FROM usuario WHERE usuario='$usuario' and id_usuario=$id");
        if ($sql->fetch_object()->total >0){ ?>
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
            <?php }else{
                $modificar=$conection->query("update usuario set nombre='$nombre',apellido='$apellido',usuario='$usuario' where id_usuario=$id ");
                if ($modificar==true) {?>
                    <script>
                    $(function notificacion() {
                        new PNotify({
                            title: "CORRECTO",
                            type: "success",
                            text: "El usuario ha sido modificado correctamente",
                            styling: "bootstrap3"
                        });
                    });
                </script>
                <?php } else {?>
                    # <script>
                    $(function notificacion() {
                        new PNotify({
                            title: "INCORRECTO",
                            type: "error",
                            text: "Error al modificar usuario",
                            styling: "bootstrap3"
                        });
                    });
                </script>
    <?php }
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