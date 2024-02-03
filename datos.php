<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--Normalize es para la adaptabilidad en los navegadores-->
    <link rel="preload" href="css/normalize.css">
    <link rel="stylesheet" href="css/normalize.css">
    <!--Mi carpeta de estulos-->
    <link rel="stylesheet" href="css/datostyle.css">

    <title>Monitoreo</title>
    <!--Icono de la pestaña-->
    <link rel="shortcut icon" href="imagenes/db.png">
<!--Libreria Boostrap para css-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" 
    crossorigin="anonymous">

</head>
<body>

    <h1 id="titulo">DATOS</h1>

   
    <main class="contenedor sombra">

    <div class="container py-4 text-center">
            <h2>Registros</h2>
            <div class="row g-4">

            <div class="col-auto">
                        <label for="num_registros" class="col-form-label">Mostrar cantidad de registros: </label>
                </div>
                <div class="col-auto">
                       <select name="num_registros" id="num_registros" class="form-select">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="15">15</option>
                        <option value="30">30</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                       </select>
                </div>

                <div class="col-auto">
                        <label for="num_registros" class="col-form-label">Numero registros: </label>
                </div>
                <!--Posicion del buscador-->
                <div class="col-3"></div>

                <div class="col-auto">
                        <label for="campo" class="col-form-label">Buscar: </label>
                </div>
                <div class="col-auto">
                        <input type="text" placeholder="Ingrese que quiere buscar" name="campo" id="campo" class="form-control">
                </div>
                <label id="lbl-total"></label>
                      
            </div>
                
      </div>
      <div id="nav-paginacion"></div>
        <table id="datos">

                <thead>
                    <th>ID</th>
                    <th>Fecha</th>
                    <th>Horas</th>
                    <th>Temperatura</th>
                    <th>PH</th>
                    <th>Estabilidad</th>
                </thead>

                <!--El id del cuerpo de mi tabla-->
                <tbody id="content">

                </tbody>
                
        </table>

              
                
        <footer id="pie">© 2022 Copyright by Ing.Brian Valdivia Navarro <span>Freelancer</span></footer>

</main>
<script>

        let paginaActual = 1
//.AJAX para refrescar datos en tiempo real

getData(paginaActual);  
document.getElementById("campo").addEventListener("keyup", function(){
        getData(1)
}, false)

document.getElementById("num_registros").addEventListener("change", function(){
        getData(paginaActual)
}, false)



function getData(pagina) {
            let input = document.getElementById("campo").value
            let num_registros = document.getElementById("num_registros").value
            let content = document.getElementById("content")

                if(pagina !=null){
                        paginaActual = pagina
                }

            let url = "consultas.php"
            let formaData = new FormData()
            formaData.append('campo', input)
            formaData.append('registros', num_registros)
            formaData.append('pagina', paginaActual)

            fetch(url, {
                    method: "POST",
                    body: formaData
                }).then(response => response.json())
                .then(data => {
                    content.innerHTML = data.data
                    document.getElementById("lbl-total").innerHTML = ' Viendo ' + data.totalFiltro +
                    ' de ' + data.totalRegistros + ' registros'
                    document.getElementById("nav-paginacion").innerHTML = data.paginacion
                }).catch(err => console.log(err))
        }

</script>

</body>
</html>