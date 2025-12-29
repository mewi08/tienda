<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Búsqueda</title>

     <!-- Estilos de bootstrap -->
    <link rel="stylesheet" href="   https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">

     <!-- Botones boostrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>
<body>
    <div class="container mt-3">
        <div>
              <a href="./index.php" class="btn btn-sm btn-outline-success">Regresar</a>
        </div>
        <div>

        
        <h5>Búsqueda por ID</h5>
        <form action="" id="form-busqueda-id">
            <div class="mb-3">
                <label for="idbuscado">ID Buscado</label>
                <div class="input-group">
                    <input type="text" id="idbuscado" class="form-control">
                     <button class="btn btn-success" type="submit"><i class="bi bi-search"></i> Buscar</button>
                </div>
                <div>
                    <label for="nombre" class="form-label">Nombre de juguete</label>
                    <input type="text" class="form-control" id="nombre" disabled>
                </div>
            </div>
        </form>
        <hr>

        <!-- BÚSQUEDA POR MARCA -->
         <h5>Búsqueda por Marca</h5>
        <form action="" id="form-busqueda-marca">
            <div class="input-group">
                <select id="marcas" class="form-select">
                    <option value="">Selecciona</option>
                    <option value="LEGO">LEGO</option>
                    <option value="Mattel">Mattel</option>
                    <option value="Hasbro">Hasbro</option>
                    <option value="Nerf">Nerf</option>
                    <option value="Vtech">Vtech</option>
                    <option value="WowWee">WowWee</option>
                    <option value="Fisher-Price">Fisher-Price</option>
                </select>
                <button class="btn btn-success" type="submit"><i class="bi bi-search"></i> Buscar</button>
            </div>

            <table class="table table-bordered mt-3" id="tabla-juguetes-marca">
                <thead>
                     <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Precio</th>
                        <th>Edad Mínima</th>
                        <th>Stock</th>
                        <th>Fecha Ingreso</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Registros -->
                </tbody>
            </table>
        </form>
        <hr>

        <!-- BÚSQUEDA POR CATEGORÍA -->
         <h5>Búsqueda por Categoría</h5>
        <form action="" id="form-busqueda-categoria">
            <div class="input-group">
                <select id="categorias" class="form-select">
                    <option value="">Selecciona</option>
                    <option value="Muñecos y figuras">Muñecos y figuras</option>
                    <option value="Construcción y creatividad">Construcción y creatividad</option>
                    <option value="Juegos educativos">Juegos educativos</option>
                    <option value="Juegos de mesa">Juegos de mesa</option>
                    <option value="Vehículos y pistas">Vehículos y pistas</option>
                    <option value="Juguetes tecnológicos">Juguetes tecnológicos</option>
                    <option value="Juguetes de acción">Juguetes de acción</option>
                </select>
                <button class="btn btn-success" type="submit"><i class="bi bi-search"></i> Buscar</button>
            </div>
            <table class="table table-bordered mt-3" id="tabla-juguetes-categoria">
                <thead>
                     <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Precio</th>
                        <th>Edad Mínima</th>
                        <th>Stock</th>
                        <th>Fecha Ingreso</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Registros -->
                </tbody>
            </table>
        </form>
    </div>
</div>
    <script>
        document.addEventListener("DOMContentLoaded", function(){
            //FUNCIÓN PARA BUSCAR POR ID
            function buscarPorId(){
                const datos = new FormData();
                datos.append("operacion","buscarPorId")
                datos.append("id" , document.querySelector("#idbuscado").value)

                fetch('../../app/controllers/juguete.controller.php',{
                    method: 'POST',
                    body:datos
                })
                .then(response => response.json())
                .then(data =>{
                    const resultado = data[0]['nombre']+ " - " + data[0]['descripcion']
                    document.querySelector("#nombre").value=resultado
                })
                .catch(error=>{
                    document.querySelector("#nombre").value= ""
                    alert("No se encontro...")
                })
            }

            //FUNCIÓN PARA BUSCAR POR MARCA
            function buscarPorMarca(){
                const datos = new FormData()
                datos.append("operacion","buscarPorMarca")
                datos.append("marca",document.querySelector("#marcas").value)
                fetch('../../app/controllers/juguete.controller.php',{
                    method: 'POST',
                    body:datos
                })
                .then(response => response.json())
                .then(data =>{
                    const tabla = document.querySelector("#tabla-juguetes-marca tbody")
                    tabla.innerHTML="";
                    data.forEach(element => {
                        tabla.innerHTML+=`
                        <tr>
                            <td>${element.id}</td>
                            <td>${element.nombre}</td>
                            <td>${element.descripcion}</td>
                            <td>${element.precio}</td>
                            <td>${element.edadminima}</td>
                            <td>${element.stock}</td>
                            <td>${element.ingreso}</td>
                        </tr>`
                    });
                })
            }

            //FUNCIÓN PARA BUSCAR POR CATEGORIA
            function buscarPorCategoria(){
                const datos = new FormData()
                datos.append("operacion","buscarPorCategoria")
                datos.append("categoria",document.querySelector("#categorias").value)
                
                fetch('../../app/controllers/juguete.controller.php',{
                    method:'POST',
                    body:datos
                })
                .then(response => response.json())
                .then(data=>{
                    const tabla = document.querySelector("#tabla-juguetes-categoria tbody")
                    tabla.innerHTML="";
                    data.forEach(element => {
                        tabla.innerHTML+=`
                        <tr>
                            <td>${element.id}</td>
                            <td>${element.nombre}</td>
                            <td>${element.descripcion}</td>
                            <td>${element.precio}</td>
                            <td>${element.edadminima}</td>
                            <td>${element.stock}</td>
                            <td>${element.ingreso}</td>
                        </tr>`
                    });
                })
            }


            document.querySelector("#form-busqueda-id").addEventListener("submit", function(event){
                event.preventDefault()
                buscarPorId()
            })

            document.querySelector("#form-busqueda-marca").addEventListener("submit", function(event){
                event.preventDefault()
                buscarPorMarca()
            })
            document.querySelector("#form-busqueda-categoria").addEventListener("submit", function(event){
                event.preventDefault()
                buscarPorCategoria()
            })
        })
    </script>

</body>
</html>