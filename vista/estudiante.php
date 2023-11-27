<?php
session_start();

if (empty($_SESSION['nombre']) && empty($_SESSION['apellido'])) {
    header('location: login/login.php');
    exit(); // Agrega exit() después de redirigir para evitar que el script siga ejecutándose.
}

?>
<style>
    ul li:nth-child(4).activo {
        background: rgb(111, 150, 214) !important;
    }
</style>

<script>
    function advertencia(event) {
        var not = confirm("¿Estás seguro que deseas eliminar?");
        if (!not) {
            event.preventDefault(); // Evita la acción predeterminada si el usuario cancela la eliminación
        }
        return not;
    }
</script>

<!-- primero se carga el topbar -->
<?php require('./layout/topbar.php'); ?>
<!-- luego se carga el sidebar -->
<?php require('./layout/sidebar.php'); ?>

<!-- inicio del contenido principal -->
<div class="page-content">

    <h4 class="text-center text-secondary">LISTA DE ESTUDIANTES</h4>
    <?php
    include "../modelo/conexion.php";
    include "../controlador/controlador_modificar_estudiante.php";
    include "../controlador/controlador_eliminar_estudiante.php";
    
    $sql = $conection->query("SELECT 
    empleado.id_empleado,
    empleado.nombre,
    empleado.apellido,
    empleado.dni,
    empleado.cargo,
    cargo.nombre as 'nom_cargo',
    empleado.horas_acumuladas

    FROM
    empleado
    INNER JOIN cargo ON empleado.cargo=cargo.id_cargo
    ");

    if ($sql) {
    ?>
        <a href="registro_estudiante.php" class="btn btn-primary btn-rounded mb-3"><i class="fa-solid fa-plus"></i> &nbsp;REGISTRAR</a>

        <table class="table table-bordered table-hover col-12" id="example">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">NOMBRE</th>
                    <th scope="col">CI</th>
                    <th scope="col">CARRERA</th>
                    <th scope="col">HORAS</th>
                    <th scope="col">ACCIONES</th>

                </tr>
            </thead>
            <tbody>
                <?php
                while ($datos = $sql->fetch_object()) {
                ?>
                    <tr>
                        <td><?= $datos->id_empleado ?></td>
                        <td><?= $datos->nombre ?>
                        <?= $datos->apellido ?>
                    </td>
                        <td><?= $datos->dni ?></td>
                        <td><?= $datos->nom_cargo ?></td>
                        <td><?= $datos->horas_acumuladas ?></td>
                        
                        <td>
                            <a href="" data-toggle="modal" data-target="#exampleModal<?= $datos->id_empleado ?>" class="btn btn-warning btn-sm-2"><i class="fa-solid fa-pen-to-square"></i></a>
                            <a href="estudiante.php? id=<?=$datos->id_empleado ?>" onclick="return advertencia(event)" class="btn btn-danger btn-sm-2"><i class="fa-solid fa-trash"></i></a>
                            <a href="kardex.php?id=<?=$datos->id_empleado ?>"  class="btn btn-success btn-sm-2"><i class="fa fa-folder"></i></a>
                        
                        </td>
                    </tr>
                    <div class="modal fade" id="exampleModal<?= $datos->id_empleado ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header d-flex justify-content-between">
                                    <h5 class="modal-title w-100" id="exampleModalLabel">Modificar Estudiante</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="" method="POST"> <!-- Agrega el atributo method y corrige el atributo action con la URL correcta -->
                                        <div hidden class="fl-flex-label mb-4 px-2 col-12 ">
                                            <input type="text" placeholder="ID" class="input input__text" name="txtid" value="<?= $datos->id_empleado ?>">
                                        </div>
                                        <div class="fl-flex-label mb-4 px-2 col-12 ">
                                            <input type="text" placeholder="Nombre" class="input input__text" name="txtnombre" value="<?= $datos->nombre ?>">
                                        </div>
                                        <div class="fl-flex-label mb-4 px-2 col-12 ">
                                            <input type="text" placeholder="Apellido" class="input input__stext" name="txtapellido" value="<?= $datos->apellido ?>">
                                        </div>
                                        <div class="fl-flex-label mb-4 px-2 col-12 ">
                                        <select name="textcargo" class="input input__select">
                                            <?php
                                            $sql2 = $conection->query("SELECT * FROM cargo");
                                            while ($datos2 = $sql2->fetch_object()) { ?>
                                                <option <?= $datos->cargo == $datos2->id_cargo ? 'selected' : '' ?> value="<?= $datos2->id_cargo ?>"><?= $datos2->nombre ?></option>
                                            <?php } ?>
                                        </select>
                                            
                                        </div>
                                        </div>
                                        <div class="text-right p-2">
                                            <a href="estudiante.php" class="btn btn-secondary btn-bordered" data-dismiss="modal">Cerrar</a>
                                            <button type="submit" value="ok" name="btnmodificar"class="btn btn-primary btn-bordered">Modificar</button>
                                            
                                        </div>
                                    </form>
                                </div>
                                
                            </div>
                        </div>
                    </div>

                <?php
                }
                ?>
            </tbody>
        </table>
    <?php
    } else {
        echo "Error en la consulta: " . $conection->error;
    }
    ?>
</div>
</div>
<?php require('./layout/footer.php'); ?>
