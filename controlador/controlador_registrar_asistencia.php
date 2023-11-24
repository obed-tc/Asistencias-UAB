<?php
if (!empty($_POST["btnentrada"])) {
    if (!empty($_POST["txtci"])) {
        $ci = $_POST["txtci"];
        $consulta = $conection->query("SELECT COUNT(*) as 'total' FROM empleado WHERE dni='$ci'");
        
        if ($consulta->fetch_object()->total > 0) {
            $id = $conection->query("SELECT id_empleado FROM empleado WHERE dni='$ci'");
            $id_empleado = $id->fetch_object()->id_empleado;
            
            $fecha = date("Y-m-d H:i:s");
            $sql = $conection->query("INSERT INTO asistencia (id_empleado, entrada) VALUES ($id_empleado, '$fecha')");
            
            if ($sql == true) {
                ?>
                <script>
                    $(function notificacion() {
                        new PNotify({
                            title: "CORRECTO",
                            type: "success",
                            text: "HOLA, BIENVENIDO",
                            styling: "bootstrap3"
                        });
                    });
                </script>
            <?php } else {
                ?>
                <script>
                    $(function notificacion() {
                        new PNotify({
                            title: "INCORRECTO",
                            type: "error",
                            text: "Error al registrar ENTRADA",
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
                        title: "INCORRECTO",
                        type: "error",
                        text: "Error CI ingresado no existe",
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
                    title: "INCORRECTO",
                    type: "error",
                    text: "Ingrese el CI",
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
<?php }

if (!empty($_POST["btnsalida"])) {
    if (!empty($_POST["txtci"])) {
        $ci = $_POST["txtci"];
        $consulta = $conection->query("SELECT COUNT(*) as 'total' FROM empleado WHERE dni='$ci'");
        if ($consulta->fetch_object()->total > 0) {
            $id = $conection->query("SELECT id_empleado FROM empleado WHERE dni='$ci'");
            $id_empleado = $id->fetch_object()->id_empleado;

            $fecha = date("Y-m-d H:i:s");
            $buqueda = $conection->query("SELECT id_asistencia FROM asistencia WHERE id_empleado=$id_empleado ORDER BY id_asistencia DESC LIMIT 1");
            $id_asistencia = $buqueda->fetch_object()->id_asistencia;
            
            $sql = $conection->query("UPDATE asistencia SET salida='$fecha' WHERE id_asistencia=$id_asistencia");

            if ($sql == true) {
                ?>
                <script>
                    $(function notificacion() {
                        new PNotify({
                            title: "CORRECTO",
                            type: "success",
                            text: "ADIOS, VUELVE PRONTO",
                            styling: "bootstrap3"
                        });
                    });
                </script>
            <?php } else {
                ?>
                <script>
                    $(function notificacion() {
                        new PNotify({
                            title: "INCORRECTO",
                            type: "error",
                            text: "Error al registrar SALIDA",
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
                        title: "INCORRECTO",
                        type: "error",
                        text: "Error CI ingresado no existe",
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
                    title: "INCORRECTO",
                    type: "error",
                    text: "Ingrese el CI",
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
<?php } ?>
