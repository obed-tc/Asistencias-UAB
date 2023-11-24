<?php
if (!empty($_POST["btnentrada"])) {
    if (!empty($_POST["txtci"])) {
        $ci = $_POST["txtci"];
        $consulta = $conection->query("SELECT COUNT(*) as 'total' FROM empleado WHERE dni='$ci'");
        
        if ($consulta->fetch_object()->total > 0) {
            $id = $conection->query("select id_empleado from empleado where dni='$ci'");
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
?>
<!-- REGISTRO DE SALIDA-->
<?php
if (!empty($_POST["btnentrada"])) {
    if (!empty($_POST["txtci"])) {
        $ci = $_POST["txtci"];
        $consulta = $conection->query("SELECT COUNT(*) as 'total' FROM empleado WHERE dni='$ci'");
            $id = $conection->query("select id_empleado from empleado where dni='$ci'");
            if ($consulta->fetch_object()->total > 0) {
            $fecha = date("Y-m-d H:i:s");
            $id_empleado = $id->fetch_object()->id_empleado;
            $buqueda=$conection->query("select id_asistencia from asistencia where id_empleado=$id_empleado order by id-asistencia desc limit 1");
            $id_asistencia=$busqueda->fetch_object()->id_asistencia;
            $sql = $conection->query(" update  asistencia set salida=$fecha'where id_asistencia=$id_asistencia");
            
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
<?php }
?>