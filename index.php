<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--Normalize es para la adaptabilidad en los navegadores-->
    <link rel="preload" href="css/normalize.css">
    <link rel="stylesheet" href="css/normalize.css">

    <!--Igresar a mi carpeta con archivos css-->
    <link rel="stylesheet" href="css/principalstyle.css">
    <!--Carga la fuente de toda la pagina web-->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">


    <!-- <meta http-equiv="refresh" content="2"> -->
    <title>Server Arduino</title>
    <link rel="shortcut icon" href="imagenes/biorreactor.png">

</head>

<body>

    <header>
        <h1 id="proyecto">Proyecto semana de la ciencia</h1>
    </header>

    <div class="nav-background">

        <nav class="navegacion-principal contenedor">
            <a href="datos.php" target="_blank">Consultar datos</a>
            <a href="sobrenosotros.html" target="_blank">Sobre nosotros</a>
        </nav>
    </div>

    <main class="contenedor sombra">



        <h1 id="titulo">Servidor de datos para el arduino</h1>

        <div class="servicios">
            <section class="servicio">

                <h3 class="subtitulos">Temperatura</h3>


                <div class="iconos">

                    <p id="temperatura" class="datos"></p>

                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-temperature-celsius" width="40" height="40" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <circle cx="6" cy="8" r="2" />
                        <path d="M20 9a3 3 0 0 0 -3 -3h-1a3 3 0 0 0 -3 3v6a3 3 0 0 0 3 3h1a3 3 0 0 0 3 -3" />
                    </svg>

                </div>

            </section>



            <section class="servicio">

                <h3 class="subtitulos">Ph</h3>


                <div class="iconos">
                    <p class="datos">0 -</p>
                    <P id="ph" class="datos"><?php echo $ph; ?></p>

                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-alert-triangle" width="40" height="40" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M12 9v2m0 4v.01" />
                        <path d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75" />
                    </svg>

                </div>

            </section>
        </div>

        <footer id="pie">© 2022 Copyright by Ing.Brian Valdivia Navarro <span>Freelancer</span></footer>

    </main>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer">
    </script>

    <script>
        obtenerDatos();

        function obtenerDatos() {
            $.ajax({
                url: "obtenerdatos.php",
                type: "get",
                datype: "json",
                success: function(res) {
                    $("#temperatura").html(res.temperatura);
                    $("#ph").html(res.ph);
                }
            });

            setTimeout(function() {
                obtenerDatos();
            }, 1000);
        }
    </script>
</body>

</html>