<?php
if (!empty($_POST["btnmodificar"])) {
    if (!empty($_POST["txtnombre"]) ){
        $nombre = $_POST["txtnombre"];
        $id = $_POST["txtid"];
        $verificarNombre = $conection->query(" SELECT COUNT(*) as 'total' FROM cargo WHERE nombre='$nombre' and id_cargo=$id ");
        if ($verificarNombre->fetch_object()->total >0){ ?>
            <script>
                $(function notificacion() {
                    new PNotify({
                        title: "INCORRECTO",
                        type: "error",
                        text: "Esta facultad <?=$nombre?> ya existe",
                        styling: "bootstrap3"
                    });
                });
            </script>
            <?php }else{
                $sql=$conection->query("update cargo set nombre='$nombre' where id_cargo=$id ");
                if ($sql==true) {?>
                    <script>
                    $(function notificacion() {
                        new PNotify({
                            title: "CORRECTO",
                            type: "success",
                            text: "La facultad  ha sido modificado correctamente",
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
                            text: "Error al modificar los datos",
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