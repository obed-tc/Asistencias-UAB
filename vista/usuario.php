<?php
session_start();

if (empty($_SESSION['nombre']) && empty($_SESSION['apellido'])) {
    header('location: login/login.php');
    exit(); // Agrega exit() después de redirigir para evitar que el script siga ejecutándose.
}

?>
<style>
    ul li:nth-child(2).activo {
        background: rgb(11, 150, 214) !important;
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

    <h4 class="text-center text-secondary">Lista de Usuarios</h4>
    <?php
    include "../modelo/conexion.php";
    include "../controlador/controlador_modificar_usuario.php";
    include "../controlador/controlador_eliminar_usuario.php";

    $sql = $conection->query("SELECT * FROM usuario");

    if ($sql) {
        ?>
        <a href="registro_usuario.php" class="btn btn-primary btn-rounded mb-3"><i class="fa-solid fa-plus" fa-plus></i>
            &nbsp;REGISTRAR</a>

        <table class="table table-bordered table-hover col-12" id="example">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">NOMBRE</th>
                    <th scope="col">APELLIDO</th>
                    <th scope="col">CORREO ELECTRONICO</th> <!-- Corregido: Cambiado UAUARIO a USUARIO -->
                    <th scope="col">ACCIONES</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($datos = $sql->fetch_object()) {
                    ?>
                    <tr>
                        <td>
                            <?= $datos->id_usuario ?>
                        </td>
                        <td>
                            <?= $datos->nombre ?>
                        </td>
                        <td>
                            <?= $datos->apellido ?>
                        </td>
                        <td>
                            <?= $datos->usuario ?>
                        </td>
                        <td>
                            <a href="" data-toggle="modal" data-target="#exampleModal<?= $datos->id_usuario ?>"
                                class="btn btn-warning btn-sm-2"><i class="fa-solid fa-pen-to-square"></i></a>
                            <a href="usuario.php?id=<?= $datos->id_usuario ?>" onclick="return advertencia(event)"
                                class="btn btn-danger btn-sm-2"><i class="fa-solid fa-trash"></i></a>
                        </td>
                    </tr>
                    <div class="modal fade" id="exampleModal<?= $datos->id_usuario ?>" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header d-flex justify-content-between">
                                    <h5 class="modal-title w-100" id="exampleModalLabel">Modificar Usuario</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <form action="" method="POST">
                                            <!-- Agrega el atributo method y corrige el atributo action con la URL correcta -->
                                            <div hidden class="fl-flex-label mb-4 px-2 col-12 ">
                                                <input type="text" placeholder="ID" class="input input__text" name="txtid"
                                                    value="<?= $datos->id_usuario ?>">
                                            </div>
                                            <div class="fl-flex-label mb-4 px-2 col-12 ">
                                                <input type="text" placeholder="Nombre" class="input input__text"
                                                    name="txtnombre" value="<?= $datos->nombre ?>">
                                            </div>
                                            <div class="fl-flex-label mb-4 px-2 col-12 ">
                                                <input type="text" placeholder="Apellido" class="input input__stext"
                                                    name="txtapellido" value="<?= $datos->apellido ?>">
                                            </div>
                                            <div class="fl-flex-label mb-4 px-2 col-12 ">
                                                <input type="email" placeholder="Correo electronico" class="input input__text"
                                                    name="txtusuario" value="<?= $datos->usuario ?>">
                                            </div>
                                            <div class="text-right p-2">
                                                <a href="usuario.php" class="btn btn-secondary btn-rounded m-2"
                                                    data-dismiss="modal">Cerrar</a>
                                                <button type="submit" value="ok" name="btnmodificar"
                                                    class="btn btn-primary btn-rounded m-2">Modificar</button>
                                            </div>
                                        </form>
                                    </div>
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
<!-- fin del contenido principal -->

<!-- por último se carga el footer -->
<?php require('./layout/footer.php'); ?>