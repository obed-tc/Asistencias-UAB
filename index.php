<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Bienvenida</title>
    <link rel="stylesheet" href="public/estilos/estilos.css">
     <!-- pNotify -->
     <link href="public/pnotify/css/pnotify.css" rel="stylesheet" />
        <link href="public/pnotify/css/pnotify.buttons.css" rel="stylesheet" />
        <link href="public/pnotify/css/custom.min.css" rel="stylesheet" />
     <!-- pnotify -->
     <script src="public/pnotify/js/jquery.min.js">
        </script>
        <script src="public/pnotify/js/pnotify.js">
        </script>
        <script src="public/pnotify/js/pnotify.buttons.js">
        </script>
</head>
<style>
    body {
        background: url(https://www.eduopinions.com/wp-content/uploads/2017/08/Universidad-Adventista-de-Bolivia-UAB-campus.jpg);
        background-size: cover;
        background-repeat: no-repeat;
        margin: 0;
        height: 100vh;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        color: white;
        text-align: center;
        font-family: 'Arial', sans-serif;
        background-color: rgba(01, 0, 0, 0.5); /* Fondo semi */
    }

    h1 {
    margin: 10px;
    color: black; /* Agregado para cambiar el color del texto a negro */
    }
    h2 {
       margin: 10px;
    background-color: rgba(255, 255, 255, 0.7); /* Fondo semitransparente para los números */
    padding: 10px;
    border-radius: 5px; /* Bordes redondeados */
    color: black; /* Color del texto */
    }

    .container {
        background-color: rgba(255, 255, 255, 0.8); /* Fondo semi transparente */
        padding: 20px;
        border-radius: 10px;
        width: 70%;
        max-width: 500px; /* Establece un ancho máximo para el contenedor */
        margin: auto; /* Centra el contenedor horizontalmente */
    }

    img {
        width: 100%;
        border-radius: 10px;
        margin-bottom: 20px;
    }

    .acceso {
    display: inline-block; /* Cambiado de 'block' a 'inline-block' */
    background-color: #2ecc71; /* Cambiado a un color rojo  */
    color: #fff;
    padding: 8px 15px; /* Ajusta el padding para cambiar el tamaño del botón */
    text-decoration: none;
    border-radius: 5px;
    margin-bottom: 20px;
}
    .CI {
        color: #fff;
    }

    input {
        padding: 15px; /* Ajusta el padding para cambiar el tamaño del cuadro de texto */
        margin: 10px 0;
        width: 95%;
        border-radius: 10px;
    }

    .botones {
        display: flex;
        justify-content: space-around;
    }

    .entrada, .salida {
    display: inline-block;
    background-color: #2ecc71;
    color: #fff;
    padding: 10px 15px; /* Ajusta el padding para separar los botones */
    text-decoration: none;
    border-radius: 5px;
    cursor: pointer;
    margin-right: 10px; /* Agregado para separar los botones */
}

    .entrada:hover, .salida:hover {
        background-color: #27ae60;
    }
</style>
<body>
    <h1>BIENVENIDO, REGISTRA TU ASISTENCIA</h1>
    <h2 id="fecha"></h2>
    <?php
    include "modelo/conexion.php";
    include "controlador/controlador_registrar_asistencia.php";

    ?>
    <div class="container">
        <img src="https://www.eduopinions.com/wp-content/uploads/2017/08/Universidad-Adventista-de-Bolivia-UAB-campus.jpg" alt="Campus Image">
        <a class="acceso" href="vista/login/login.php">Ingresar al sistema</a>
        <p class="CI">Ingrese su CI</p>
        <form action="" method="POST">
            <input type="text" placeholder="numero de CI" name="txtci">
            <div class="botones">
                <button clase="entrada"type="submit" name="btnentrada" value="ok">ENTRADA</button>
                <button clase="salida"type="submit" name="btnsalida" value="ok">SALIDA</button>
            </div>
        </form>
    </div>

    <script>
        
        setInterval(() => {
            let fecha = new Date();
        let fechaHora = fecha.toLocaleString();
        document.getElementById("fecha").textContent = fechaHora;
        }, 1000);
    </script>
</body>
</html>
