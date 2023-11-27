<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asistencias UAB</title>
    <link rel="stylesheet" href="public/estilos/estilos.css">
    <!-- pNotify -->
    <link href="public/pnotify/css/pnotify.css" rel="stylesheet" />
    <link href="public/pnotify/css/pnotify.buttons.css" rel="stylesheet" />
    <link href="public/pnotify/css/custom.min.css" rel="stylesheet" />
    <!-- pnotify -->
    <!-- Agrega estas líneas en la sección head de tu HTML -->
    <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>

    <script src="public/pnotify/js/jquery.min.js"></script>
    <script src="public/pnotify/js/pnotify.js"></script>
    <script src="public/pnotify/js/pnotify.buttons.js"></script>
</head>
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    html,
    body {
        height: 100%;
    }

    body {
        background: lightblue;
        font-size: 16px;
        color: #fff;
    }

    /* reloj */

    .widget {
        height: 40%;
        padding: 20px;

    }

    .widget p {
        display: inline-block;
        line-height: 1em;
    }

    .fecha {
        font-family: arial;
        text-align: center;
        font-size: 1.5em;
        margin-bottom: 5px;
        background: rgba(0, 0, 0, .5);
        padding: 20px;
        width: 100%;
    }

    .reloj {
        font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;
        width: 100%;
        padding: 20px;
        font-size: 4em;
        text-align: center;
        background: rgba(0, 0, 0, .5);
    }

    .reloj .cajaSegundos {
        display: inline-block;
    }

    .reloj .ampm,
    .reloj .segundos {
        display: block;
        font-size: 2rem;
    }

    .main {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
    }

    body {
        background: url(https://www.uab.edu.bo/wp-content/uploads/2022/01/web3.jpg);
        background-size: cover;
        background-repeat: no-repeat;
        margin: 0;
        height: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        color: white;
        text-align: center;
        font-family: 'Arial', sans-serif;
        background-color: rgba(1, 0, 0, 0.5);
        /* Fondo semi */
    }

    h1,
    h2 {
        margin: 10px;
        color: black;
        /* Agregado para cambiar el color del texto a negro */
    }

    h2 {
        background-color: rgba(255, 255, 255, 0.7);

        /* Fondo semitransparente para los números */
        padding: 10px;
        border-radius: 5px;
        /* Bordes redondeados */
    }

    .container {
        background: rgba(0, 0, 0, .5);

        /* Fondo semi transparente */
        padding: 20px;
        border-radius: 10px;
        width: 500px;
        /* Establece un ancho máximo para el contenedor */
        /* Centra el contenedor horizontalmente */
    }

    img {
        width: 100%;
        border-radius: 10px;
        margin-bottom: 20px;
    }

    .acceso {
        display: inline-block;
        /* Cambiado de 'block' a 'inline-block' */
        background-color: #2ecc71;
        margin: 10px;
        position: absolute;
        top: 0;
        right: 0;
        /* Cambiado a un color rojo  */
        color: #fff;
        padding: 10px 20px;
        /* Ajusta el padding para cambiar el tamaño del botón */
        text-decoration: none;
        border-radius: 5px;
    }

    .acceso:hover {
        background-color: #7CF6B0;
        color: #000;
    }

    .CI {
        color: #fff;
    }

    input {
        padding: 15px;
        /* Ajusta el padding para cambiar el tamaño del cuadro de texto */
        margin: 10px 0;
        width: 95%;
        border-radius: 10px;
    }

    .botones {
        display: flex;
        justify-content: space-around;
    }

    #entrada,
    #salida {
        display: inline-block;
        background-color: #2ecc71;
        color: #fff;
        padding: 15px 35px;
        /* Ajusta el padding para separar los botones */
        text-decoration: none;
        border-radius: 5px;
        cursor: pointer;
        margin-right: 10px;
        /* Agregado para separar los botones */
    }

    #entrada:hover,
    #salida:hover {
        background-color: #27ae60;
    }

    .titulo {
        font-size: 30px;
        position: absolute;
        margin-top: 30px;
        top: 0;
        font-family: 'Arial Narrow Bold', sans-serif;
        font-weight: bold;
    }

    #txtci {
        font-size: 15px;
    }
</style>

<body>
    <?php
    date_default_timezone_set("America/La_Paz");
    ?>
    <h1 class="titulo">BIENVENIDO, REGISTRA TU ASISTENCIA</h1>
    <div class="main">

        <!-- reloj  -->
        <div class="contenedor">
            <div class="widget">
                <div class="fecha">
                    <p id="diaSemana" class="diaSemana"></p>
                    <p id="dia" class="dia"></p>
                    <p>de</p>
                    <p id="mes" class="mes"></p>
                    <p>del</p>
                    <p id="anio" class="anio"></p>
                </div>
                <div class="reloj">
                    <p id="horas" class="horas"></p>
                    <p>:</p>
                    <p id="minutos" class="minutos"></p>
                    <p>:</p>
                    <div class="cajaSegundos">
                        <p id="ampm" class="ampm"></p>
                        <p id="segundos" class="segundos"></p>
                    </div>
                </div>
            </div>
        </div>
        <?php
        include "modelo/conexion.php";
        include "controlador/controlador_registrar_asistencia.php";
        ?>
        <div class="container">
            <img src="https://www.uab.edu.bo/wp-content/uploads/2022/03/DSC_1712.jpg" alt="Campus Image">
            <a class="acceso" href="vista/login/login.php">Ingresar al sistema</a>
            <p class="CI">Ingrese su CI</p>
            <form action="" method="POST">
                <input type="text" placeholder="Número de CI" name="txtci" id="txtci">
                <div class="botones">
                    <button id="entrada" type="submit" name="btnentrada" value="ok">ENTRADA</button>

                    <button id="salida" class="salida" type="submit" name="btnsalida" value="ok">SALIDA</button>
                </div>
            </form>
        </div>
    </div>


    <script>
        $(function () {
            var actualizarHora = function () {
                var fecha = new Date(),
                    hora = fecha.getHours(),
                    minutos = fecha.getMinutes(),
                    segundos = fecha.getSeconds(),
                    diaSemana = fecha.getDay(),
                    dia = fecha.getDate(),
                    mes = fecha.getMonth(),
                    anio = fecha.getFullYear(),
                    ampm;

                var $pHoras = $("#horas"),
                    $pSegundos = $("#segundos"),
                    $pMinutos = $("#minutos"),
                    $pAMPM = $("#ampm"),
                    $pDiaSemana = $("#diaSemana"),
                    $pDia = $("#dia"),
                    $pMes = $("#mes"),
                    $pAnio = $("#anio");
                var semana = ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'];
                var meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];

                $pDiaSemana.text(semana[diaSemana]);
                $pDia.text(dia);
                $pMes.text(meses[mes]);
                $pAnio.text(anio);
                if (hora >= 12) {
                    hora = hora - 12;
                    ampm = "PM";
                } else {
                    ampm = "AM";
                }
                if (hora == 0) {
                    hora = 12;
                }
                if (hora < 10) { $pHoras.text("0" + hora) } else { $pHoras.text(hora) };
                if (minutos < 10) { $pMinutos.text("0" + minutos) } else { $pMinutos.text(minutos) };
                if (segundos < 10) { $pSegundos.text("0" + segundos) } else { $pSegundos.text(segundos) };
                $pAMPM.text(ampm);

            };


            actualizarHora();
            var intervalo = setInterval(actualizarHora, 1000);
        });

        let dni = document.getElementById("txtci");
        dni.addEventListener("input", function () {
            if (this.value.length > 8) {
                this.value = this.value.slice(0, 8);
            }
        });

        // eventos para la entrada y salida
        document.addEventListener("keyup", function (event) {
            if (event.code == "ArrowLeft") {
                document.getElementById("salida").click();
            } else {
                if (event.code == "ArrowRight") {
                    document.getElementById("entrada").click();
                }
            }
        });
    </script>
</body>

</html>