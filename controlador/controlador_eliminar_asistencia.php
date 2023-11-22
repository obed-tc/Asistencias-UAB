<?php
include "../modelo/conexion.php"; // Asegúrate de incluir el archivo de conexión

if (!empty($_GET["id"])) {
    $id = $_GET["id"];
    $sql = $conection->query("DELETE FROM asistencia WHERE id_asistencia = $id");

    if ($sql) {?>
        <script>
            $(function notificacion(){
                new PNotify({
                    title: "CORRECTO",
                    type: "success",
                    text: "LA ASISTENCIA SE HA ELIMINADO CORECTAMENTE",
                    styling: "bootstrap3"
                });
            });
        </script>
    <?php } else { ?>
        <script>
            $(function notificacion(){
                new PNotify({
                    title: "ERROR",
                    type: "error",
                    text: "NO SE HA PODIDO ELIMINAR EL REGISTRO",
                    styling: "bootstrap3"
                });
            });
        </script>
<?php }?>
    <script>
        setTimeout(()=> {
            window.history.replaceState(null,null,window.location.pathname);
        },0);
    </script>
<?php }
