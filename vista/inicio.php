<?php
session_start();
if (empty($_SESSION['nombre']) and empty($_SESSION['apellido'])) {
    header('location:login/login.php');
}

?>
<style>
    ul li:nth-child(1).activo{
        background: rgb(11,150,214)!important;
    }
</style>


    
<script>
    function advertencia(){
        var not=confirm("estas seguro q desea eliminar?");
        return not;
    }
</script>
<!-- primero se carga el topbar -->
<?php require('./layout/topbar.php'); ?>
<!-- luego se carga el sidebar -->
<?php require('./layout/sidebar.php'); ?>

<!-- inicio del contenido principal -->
<div class="page-content">

<h4 class="text-center text-secondary">ASISTENSIA DE ESTUDIANTES</h4>
<?php
include "../modelo/conexion.php";
include "../controlador/controlador_eliminar_asistencia.php";

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
if($sql){
?>
<table class="table table-bordered table-hover col-12" id="example">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">ESTUDIANTES</th>
            <th scope="col">CI</th>
            <th scope="col">Cargo</th>
            <th scope="col">ENTRADA</th>
            <th scope="col">SALIDA</th>
        </tr>
    </thead>
    <tbody>
        <?php
        while ($datos=$sql->fetch_object()) { ?>
             <tr>
                <td><?= $datos->id_asistencia?></td>
                <td><?= $datos->nom_empleado. " ".$datos->apellido?></td>
                <td><?= $datos->dni?></td>
                <td><?= $datos->nom_cargo?></td>
                <td><?= $datos->entrada?></td>
                <td><?= $datos->salida?></td>
                <td>
                    <a href="inicio.php?id=<?=$datos->id_asistencia?>"onclick="advertencia(event)" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></a></i></td>
            </tr>
      
        <?php }
        } else {
            echo "Error en la consulta: " . $conection->error;
        }
        ?>
       
    </tbody>
</table>


</div>
</div>
<!-- fin del contenido principal -->


<!-- por ultimo se carga el footer -->
<?php require('./layout/footer.php'); ?>