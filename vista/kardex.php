<?php
session_start();

if (empty($_SESSION['nombre']) && empty($_SESSION['apellido'])) {
    header('location:login/login.php');
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
?>
<style>
    ul li:nth-child(5).activo {
        background: rgb(11, 150, 214) !important;
    }

    .contenido {
        padding-left: 20px;
        padding-right: 20px;
    }
</style>

<script>
    function advertencia() {
        return confirm("¿Estás seguro que deseas eliminar?");
    }
</script>

<?php require('./layout/topbar.php'); ?>
<?php require('./layout/sidebar.php'); ?>

<div id="contenido" class="page-content">
    <button id="btnImprimir">Descargar PDF</button>
    <h4 class="text-center text-secondary">KARDEX ESTUDIANTE</h4>

    <?php
    include '../modelo/conexion.php';
    $sql = $conection->query("SELECT 
        empleado.nombre,
        empleado.apellido,
        empleado.dni,
        empleado.horas_acumuladas,
        cargo.nombre as nom_cargo
    FROM
        empleado
        JOIN cargo ON empleado.cargo = cargo.id_cargo
    WHERE
        empleado.id_empleado = $id");


    $sqlHistorial = $conection->query("SELECT
            asistencia.id_asistencia,
            asistencia.id_empleado,
            asistencia.entrada,
            asistencia.salida,
            empleado.nombre as 'nom_empleado',
            empleado.apellido,
            empleado.dni,
            cargo.nombre as 'nom_cargo'
        FROM
            asistencia
        INNER JOIN empleado ON asistencia.id_empleado = empleado.id_empleado
        INNER JOIN cargo ON empleado.cargo = cargo.id_cargo
        WHERE
        empleado.id_empleado = $id
        ");
    ?>

    <div class="row">


        <div class="contenido">
            <table class="table w-30">
                <thead>
                    <tr>
                        <th scope="col" colspan="4" class="text-center">INFORMACIÓN DEL EMPLEADO</th>
                    </tr>
                    <tr>
                        <th scope="col">Nombres y Apellidos</th>
                        <th scope="col">Facultad</th>
                        <th scope="col">Horas Totales</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($datos = $sql->fetch_object()) {
                        ?>
                        <tr>
                            <td>
                                <?= $datos->nombre ?>
                                <?= $datos->apellido ?>
                            </td>
                            <td>
                                <?= $datos->nom_cargo ?>
                            </td>

                            <td>
                                <?= $datos->horas_acumuladas ?>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
            <table class="table table-bordered table-hover w-50">
                <thead>


                    <tr>
                        <th scope="col">FECHA</th>
                        <th scope="col">ENTRADA</th>
                        <th scope="col">SALIDA</th>
                        <th scope="col">TOTAL</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($datos = $sqlHistorial->fetch_object()) { ?>
                        <tr>
                            <td>
                                <?= (new DateTime($datos->entrada))->format("d-m-Y") ?>
                            </td>
                            <td>
                                <?= (new DateTime($datos->entrada))->format(" H:i:s") ?>
                            </td>
                            <td>
                                <?= (new DateTime($datos->salida))->format(" H:i:s") ?>
                            </td>
                            <td>
                                <?php
                                $entrada = new DateTime($datos->entrada);
                                $salida = new DateTime($datos->salida);
                                $diferencia = $entrada->diff($salida);
                                $tiempoTranscurrido = $diferencia->format('%H:%I:%S');
                                echo $tiempoTranscurrido;
                                ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <script>
            function imprimir() {
                window.print();
                console.log("LLEgo")
            }

            document.getElementById('btnImprimir').addEventListener('click', imprimir);
        </script>
    </div>
</div>
</div>

<?php require('./layout/footer.php'); ?>