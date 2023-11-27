<?php


session_start();
if (empty($_SESSION['nombre']) and empty($_SESSION['apellido'])) {
    header('location:login/login.php');
}
if (isset($_GET['export']) && $_GET['export'] == 'excel') {

    // Encabezados para la descarga de un archivo CSV
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment;filename="reporte_asistencias.csv"');
    header('Cache-Control: max-age=0');

    // Salida directa al archivo CSV (puedes redirigir esto a un archivo si es necesario)
    $output = fopen('php://output', 'w');

    // Encabezados de la tabla
    $headers = ['ID Asistencia', 'ID Empleado', 'Entrada', 'Salida', 'Nombre Empleado', 'Apellido', 'DNI', 'Nombre Cargo'];
    fputcsv($output, $headers);
    include "../modelo/conexion.php";
    include "../controlador/controlador_eliminar_asistencia.php";
    // Obtener datos desde la base de datos
    $rowData = $conection->query("SELECT
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
INNER JOIN cargo ON empleado.cargo = cargo.id_cargo");

    // Agregar datos al archivo CSV
    foreach ($rowData as $row) {
        fputcsv($output, $row);
    }

    fclose($output);
    exit();
}

?>

<style>
    ul li:nth-child(1).activo {
        background: rgb(11, 150, 214) !important;
    }

    .card {
        padding: 20px;
        transform:
            perspective(800px) rotateY(-8deg);
        transition: transform 1s ease 0s;
        border-radius: 4px;
        box-shadow:
            rgba(0, 0, 0, 0.024) 0px 0px 0px 1px,
            rgba(0, 0, 0, 0.05) 0px 1px 0px 0px,
            rgba(0, 0, 0, 0.03) 0px 0px 8px 0px,
            rgba(0, 0, 0, 0.1) 0px 20px 30px 0px;

        &:hover {
            transform: perspective(800px) rotateY(-4deg);
        }
    }

    .contenido-export {
        display: flex;
        justify-content: space-between;
    }

    .button-export {
        background-color: green;
        padding: 10px 20px;
        color: white;
        margin-bottom: 10px;
        border-radius: 10px;
    }
</style>

<script>
    function advertencia() {
        var not = confirm("¿Estás seguro de que deseas eliminar?");
        return not;
    }
</script>

<?php
// Función para calcular el promedio de asistencias por mes
function calcularPromedioPorMes()
{
    global $conection;
    $query = "SELECT COUNT(id_asistencia) as total FROM asistencia WHERE MONTH(entrada) = MONTH(CURDATE())";
    $result = $conection->query($query);
    $data = $result->fetch_assoc();
    return $data['total'];
}

// Función para obtener el número de asistencias semanales
function obtenerAsistenciasSemanales()
{
    global $conection;
    $query = "SELECT COUNT(id_asistencia) as total FROM asistencia WHERE WEEK(entrada) = WEEK(CURDATE())";
    $result = $conection->query($query);
    $data = $result->fetch_assoc();
    return $data['total'];
}

// Función para calcular el promedio de asistencias diarias
function calcularPromedioDiario()
{
    global $conection;
    $query = "SELECT COUNT(id_asistencia) as total FROM asistencia WHERE DATE(entrada) = CURDATE()";
    $result = $conection->query($query);
    $data = $result->fetch_assoc();
    return $data['total'];
}
?>


<!-- primero se carga el topbar -->
<?php require('./layout/topbar.php'); ?>
<!-- luego se carga el sidebar -->
<?php require('./layout/sidebar.php'); ?>

<!-- inicio del contenido principal -->
<div class="page-content">

    <h4 class="text-center text-secondary ">
        <b> REPORTES 2023</b>

    </h4>
    <div class="contenido-export">
        <div></div>
        <a href="?export=excel" class="button-export">Exportar a Excel</a>

    </div>


    <?php
    include "../modelo/conexion.php";
    include "../controlador/controlador_eliminar_asistencia.php";

    // Obtener datos para la tabla
    $sql = $conection->query("SELECT
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
    INNER JOIN cargo ON empleado.cargo = cargo.id_cargo");


    ?>


    <!-- Caja 1: Promedio de asistencias por mes -->
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Promedio por Mes</h5>
                <?php
                $promedioPorMes = calcularPromedioPorMes();
                echo "<p class='card-text'>$promedioPorMes</p>";
                ?>
            </div>
        </div>
    </div>

    <!-- Caja 2: Asistencias semanales -->
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Asistencias Semanales</h5>
                <?php
                $asistenciasSemanles = obtenerAsistenciasSemanales();
                echo "<p class='card-text'>$asistenciasSemanles</p>";
                ?>
            </div>
        </div>
    </div>

    <!-- Caja 3: Promedio de asistencias diarias -->
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Promedio Diario</h5>
                <?php
                $promedioDiario = calcularPromedioDiario();
                echo "<p class='card-text'>$promedioDiario</p>";
                ?>
            </div>
        </div>
    </div>
    <h3>Horas acumuladas</h3>

    <canvas id="graficoEstudiantesDestacados" width="400" height="200"></canvas>

    <?php
    // Función para obtener datos de estudiantes destacados
    function obtenerEstudiantesDestacados()
    {
        global $conection;
        $query = "SELECT nombre, horas_acumuladas FROM empleado ORDER BY horas_acumuladas DESC LIMIT 5";
        $result = $conection->query($query);

        $estudiantesDestacados = [];
        while ($row = $result->fetch_assoc()) {
            $estudiantesDestacados[$row['nombre']] = $row['horas_acumuladas'];
        }

        return $estudiantesDestacados;
    }
    ?>
    <h3>Reporte de asistencias</h3>

    <!-- Agregar Elemento Canvas para el Gráfico con tamaño reducido -->
    <canvas id="graficoAsistencia" width="300" height="150"></canvas>

    <!-- Agregar tabla para mostrar el número de asistencias -->
    <table class="table table-bordered table-hover col-12 mt-4">
        <thead>
            <tr>
                <th scope="col">Estudiante</th>
                <th scope="col">Asistencias</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $count = 0;
            $sqlAsistencias = $conection->query("SELECT nombre, COUNT(id_asistencia) as cantidad FROM asistencia INNER JOIN empleado ON asistencia.id_empleado = empleado.id_empleado GROUP BY nombre");

            while ($datosAsistencias = $sqlAsistencias->fetch_object() and $count < 5) {
                $count++;
                ?>
                <tr>
                    <td>
                        <?= $datosAsistencias->nombre ?>
                    </td>
                    <td>
                        <?= $datosAsistencias->cantidad ?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <h3>Asistencias por facultades</h3>
    <canvas id="graficoAsistenciasPorCargo" width="400" height="200"></canvas>
</div>
</div>
<!-- fin del contenido principal -->

<!-- por último se carga el footer -->


<?php require('./layout/footer.php'); ?>

<!-- Script de Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Obtener datos para el gráfico
        <?php
        $nombresEstudiantes = [];
        $asistencias = [];

        $sqlGrafico = $conection->query("SELECT nombre, COUNT(id_asistencia) as cantidad FROM asistencia INNER JOIN empleado ON asistencia.id_empleado = empleado.id_empleado GROUP BY nombre");

        while ($datosGrafico = $sqlGrafico->fetch_object()) {
            $nombresEstudiantes[] = $datosGrafico->nombre;
            $asistencias[] = $datosGrafico->cantidad;
        }
        ?>

        // Configuración del gráfico
        var ctx = document.getElementById('graficoAsistencia').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($nombresEstudiantes); ?>,
                datasets: [{
                    label: 'Asistencias',
                    data: <?php echo json_encode($asistencias); ?>,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Obtener datos para el nuevo gráfico
        <?php
        $nombresCargos = [];
        $asistenciasPorCargo = [];

        $sqlGraficoCargo = $conection->query("SELECT cargo.nombre as nombre_cargo, COUNT(asistencia.id_asistencia) as cantidad FROM asistencia INNER JOIN empleado ON asistencia.id_empleado = empleado.id_empleado INNER JOIN cargo ON empleado.cargo = cargo.id_cargo GROUP BY cargo.nombre");

        while ($datosGraficoCargo = $sqlGraficoCargo->fetch_object()) {
            $nombresCargos[] = $datosGraficoCargo->nombre_cargo;
            $asistenciasPorCargo[] = $datosGraficoCargo->cantidad;
        }
        ?>

        // Configuración del nuevo gráfico de torta
        var ctxCargo = document.getElementById('graficoAsistenciasPorCargo').getContext('2d');
        var myChartCargo = new Chart(ctxCargo, {
            type: 'pie',
            data: {
                labels: <?php echo json_encode($nombresCargos); ?>,
                datasets: [{
                    data: <?php echo json_encode($asistenciasPorCargo); ?>,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                    ],
                    borderWidth: 1
                }]
            }
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Obtener datos para el gráfico de estudiantes destacados
        <?php
        $estudiantesDestacados = obtenerEstudiantesDestacados();
        $nombresEstudiantesDestacados = array_keys($estudiantesDestacados);
        $tiemposEstudiantesDestacados = array_values($estudiantesDestacados);
        ?>

        // Convertir tiempos de formato HH:mm:ss a horas en JavaScript
        var horasAcumuladas = <?php echo json_encode($tiemposEstudiantesDestacados); ?>;
        horasAcumuladas = horasAcumuladas.map(function (tiempo) {
            var partes = tiempo.split(':');
            var horas = parseInt(partes[0], 10);
            var minutos = parseInt(partes[1], 10);
            var segundos = parseInt(partes[2], 10);

            return horas + minutos / 60 + segundos / 3600;
        });

        console.log('Horas Acumuladas:', horasAcumuladas);

        // Configuración del gráfico de estudiantes destacados
        var ctxEstudiantesDestacados = document.getElementById('graficoEstudiantesDestacados').getContext('2d');
        var myChartEstudiantesDestacados = new Chart(ctxEstudiantesDestacados, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($nombresEstudiantesDestacados); ?>,
                datasets: [{
                    label: 'Horas Acumuladas',
                    data: horasAcumuladas,
                    backgroundColor: 'rgba(255, 206, 86, 0.3)',

                    borderColor: 'rgba(255, 206, 86, 1)',

                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>