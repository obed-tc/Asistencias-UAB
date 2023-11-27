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

            $fecha_salida = date("Y-m-d H:i:s");
            $buqueda = $conection->query("SELECT id_asistencia, entrada FROM asistencia WHERE id_empleado=$id_empleado ORDER BY id_asistencia DESC LIMIT 1");
            $resultado = $buqueda->fetch_object();
            $id_asistencia = $resultado->id_asistencia;
            $fecha_entrada = $resultado->entrada;

            // Calcular la diferencia de tiempo en segundos
            $diferencia_tiempo = strtotime($fecha_salida) - strtotime($fecha_entrada);

            // Convertir la diferencia de tiempo a formato HH:MM:SS
            $duracion_formato = gmdate("H:i:s", $diferencia_tiempo);

            // Actualizar la salida en la tabla asistencia
            $sql_salida = $conection->query("UPDATE asistencia SET salida='$fecha_salida' WHERE id_asistencia=$id_asistencia");

            // Actualizar horas_acumuladas en la tabla empleado
            $sql_acumulado = $conection->query("UPDATE empleado SET horas_acumuladas = ADDTIME(horas_acumuladas, '$duracion_formato') WHERE id_empleado = $id_empleado");

            if ($sql_salida && $sql_acumulado) {
                $nuevas_horas_acumuladas = $conection->query("SELECT horas_acumuladas FROM empleado WHERE id_empleado=$id_empleado")->fetch_object()->horas_acumuladas;

                ?>
                <script>
                    $(function notificacion() {
                        new PNotify({
                            title: "CORRECTO",
                            type: "success",
                            text: "ADIOS, VUELVE PRONTO.\nHoras acumuladas: <?php echo $nuevas_horas_acumuladas; ?>",
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
                            text: "Error al registrar SALIDA o actualizar horas_acumuladas",
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