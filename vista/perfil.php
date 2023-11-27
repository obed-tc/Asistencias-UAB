<?php
session_start();

if (empty($_SESSION['nombre']) && empty($_SESSION['apellido'])) {
    header('location:login/login.php');
    exit(); // Agrega exit() después de redirigir para evitar que el script siga ejecutándose.
}
$id = $_SESSION["id"];
?>


<script>
    function advertencia() {
        return confirm("¿Estás seguro que deseas eliminar?");
    }
</script>

<!-- primero se carga el topbar -->
<?php require('./layout/topbar.php'); ?>
<!-- luego se carga el sidebar -->
<?php require('./layout/sidebar.php'); ?>

<!-- inicio del contenido principal -->
<div class="page-content">
    <h4 class="text-center text-secondary">PERFIL</h4>
    <?php
    include '../modelo/conexion.php';
    include "../controlador/controlador_modificar_perfil.php";
    $sql = $conection->query("select * from usuario where id_usuario=$id");
    ?>

    <div class="row">
        <form action="" method="POST">
            <?php
            while ($datos = $sql->fetch_object()) { ?>
                <div hidden class="fl-flex-label mb-4 px-2 col-12 col-md-6">
                    <input type="text" placeholder="Nombre" class="input input__select" name="txtid"
                        value="<?= $datos->id_usuario ?>">
                </div>
                <div class="fl-flex-label mb-4 px-2 col-12 col-md-6">
                    <input type="text" placeholder="Nombre" class="input input__select" name="txtnombre"
                        value="<?= $datos->nombre ?>">
                </div>
                <div class="fl-flex-label mb-4 px-2 col-12 col-md-6">
                    <input type="text" placeholder="Apelido" class="input input__select" name="txtapellido"
                        value="<?= $datos->apellido ?>">
                </div>
                <div class="fl-flex-label mb-4 px-2 col-12 col-md-6">
                    <input type="text" placeholder="Correo electronico" class="input input__select" name="txtusuario"
                        value="<?= $datos->usuario ?>">
                </div>

                <div class="text-right p-2">
                    <!--<a href="usuario.php" class="btn btn-secondary btn-rounded">Atras</a>-->
                    <button type="submit" value="ok" name="btnregistrar"
                        class="btn btn-primary btn-rounded">Modificar</button>
                </div>

                <?php
            }
            ?>

        </form>
    </div>
</div>
</div>
<!-- fin del contenido principal -->

<!-- por último se carga el footer -->
<?php require('./layout/footer.php'); ?>