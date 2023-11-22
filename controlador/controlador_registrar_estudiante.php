<?php
if (!empty($_POST["btnregistrar"])) {
    if (!empty($_POST["txtnombre"]) && !empty($_POST["txtapellido"]) && !empty($_POST["txtcargo"])) {
        $nombre = $_POST["txtnombre"]; // Corregido el nombre del campo
        $apellido = $_POST["txtapellido"];
        $cargo = $_POST["txtcargo"];
        $sql = $conection->query("INSERT INTO empleado(nombre, apellido, cargo) VALUES ('$nombre', '$apellido', $cargo)");
        if ($sql == true) {
            ?>
            <script>
            $(function notificacion() {
                new PNotify({
                    title: "CORRECTO",
                    type: "success",
                    text: "Estudiante registrado correctamente",
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
                    text: "Error al registrar empleado",
                    styling: "bootstrap3"
                });
            });
            </script>
            <?php
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
