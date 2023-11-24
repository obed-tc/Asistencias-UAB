<?php
if (!empty($_GET["id"])){
    $id = $_GET["id"];
    $sql=$conection->query("delete from empleado where id_empleado=$id");
    if ($sql==true) {?>
      <script>
            $(function notificacion() {
                new PNotify({
                    title: "CORRECTO",
                    type: "success",
                    text: "El usuario ha sido eliminado correctamente",
                    styling: "bootstrap3"
                });
            });
        </script>
    <?php } else {?>
        <script>
            $(function notificacion() {
                new PNotify({
                    title: "CORRECTO",
                    type: "success",
                    text: "Error al eiminar estudiante",
                    styling: "bootstrap3"
                });
            });
        </script>
        <?php }?>

<script>
setTimeout(() => {
    window.history.replaceState(null, null, window.location.pathname);
}, 0);
</script>
<?php
}
?>
