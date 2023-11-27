<?php
session_start();

if (empty($_SESSION['nombre']) && empty($_SESSION['apellido'])) {
    header('location:login/login.php');
    exit(); // Agrega exit() después de redirigir para evitar que el script siga ejecutándose.
}

?>
<style>
    ul li:nth-child(2).activo {
        background: rgb(11, 150, 214) !important;
    }
</style>

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
    <h4 class="text-center text-secondary">REGISTRO DE USUARIOS</h4>
    <?php
    include '../modelo/conexion.php';
    include "../controlador/controlador_registrar_usuario.php"
        ?>

    <div class="row">
        <form action="" method="POST">
            <!-- Agrega el atributo method y corrige el atributo action con la URL correcta -->
            <div class="fl-flex-label mb-4 px-2 col-12 col-md-6">
                <input type="text" placeholder="Nombre" class="input input__select" name="txtnombre">
            </div>
            <div class="fl-flex-label mb-4 px-2 col-12 col-md-6">
                <input type="text" placeholder="Apellido" class="input input__select" name="txtapellido">
            </div>
            <div class="fl-flex-label mb-4 px-2 col-12 col-md-6">
                <input type="email" placeholder="Correo electronico" class="input input__select" name="txtusuario">
            </div>
            <div class="fl-flex-label mb-4 px-2 col-12 col-md-6">
                <input type="password" placeholder="Contraseña" class="input input__select" name="txtpassword">
            </div>
            <div class="text-right p-2">
                <a href="usuario.php" class="btn btn-secondary btn-rounded">Atras</a>
                <button type="submit" value="ok" name="btnregistrar"
                    class="btn btn-primary btn-rounded">Registrar</button>
            </div>
        </form>
    </div>
</div>
</div>
<!-- fin del contenido principal -->

<!-- por último se carga el footer -->
<?php require('./layout/footer.php'); ?>