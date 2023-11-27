<?php
if (!empty($_POST["btnregistrar"])) {
    if (!empty($_POST["txtnombre"]) && !empty($_POST["txtapellido"]) && !empty($_POST["txtdni"]) && !empty($_POST["textcargo"])) {
        $nombre = $_POST["txtnombre"];
        $apellido = $_POST["txtapellido"];
        $dni = $_POST["txtdni"];
        $cargo = $_POST["textcargo"];

        $sql = $conection->query("SELECT COUNT(*) as 'total' FROM empleado WHERE dni='$dni'");
        $total = $sql->fetch_object()->total;

        if ($total > 0) {
            ?>
            <script>
                $(function notificacion() {
                    new PNotify({
                        title: "ERROR",
                        type: "error",
                        text: "Este CI <?= $dni ?> ya existe",
                        styling: "bootstrap3"
                    });
                });
            </script>
            <?php
        } else {
            $sql = $conection->query("INSERT INTO empleado(nombre, apellido, dni, cargo) VALUES ('$nombre', '$apellido', '$dni', '$cargo')");
            if ($sql == true) {
                ?>
                <script>
                    $(function notificacion() {
                        new PNotify({
                            title: "CORRECTO",
                            type: "success",
                            text: "Empleado registrado correctamente",
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