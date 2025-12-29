<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Juguetes</title>
    <!-- Estilos de bootstrap -->
    <link rel="stylesheet" href="   https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">

    <!-- js bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container">
        <div>
            <h3>Mantenimiento de juguetes</h3>
            <p>Este módulo permitirá el listado, eliminación y edición</p>
            <a href="./crear.php">Registrar</a>
        </div>
        <hr>
        <div class="table-responsive">
            <table class="table table-sm table-striped" id="tabla-juguetes">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Marca</th>
                        <th>Precio</th>
                        <th>Categoria</th>
                        <th>Edad Mínima</th>
                        <th>Stock</th>
                        <th>Fecha Ingreso</th>
                        <th>Operaciones</th>
                    </tr>
                </thead>
                <tbody>
                <!-- Registros de la base de datos -->
            </tbody>
        </table>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function(){
            function obtenerDatos(){
                const datos = new FormData()
                datos.append("operacion","listar")
                fetch('../../app/controllers/juguete.controller.php',{
                    method: 'POST',
                    body: datos
                })
                    .then(response => response.json())
                    .then (data=>{
                        const tabla = document.querySelector("#tabla-juguetes tbody")
                        tabla.innerHTML=""
                        data.forEach(element => {
                            tabla.innerHTML +=`
                            <tr>
                                <td> ${element.nombre} </td>
                                <td> ${element.descripcion} </td>
                                <td> ${element.marca} </td>
                                <td> ${element.precio} </td>
                                <td> ${element.categoria} </td>
                                <td> ${element.edadminima} </td>
                                <td> ${element.stock} </td>
                                <td> ${element.ingreso} </td>
                                <td>
                                    <a href='#'data-id='${element.id}' class='btn btn-sm btn-danger'>Eliminar</a>
                                    <a href='#' class='btn btn-sm btn-info'>Editar</a>
                                </td>
                            </tr>`;
                        });
                    })
            } obtenerDatos();
            
            //Delegación de eventos
            const tabla = document.querySelector("#tabla-juguetes")
            tabla.addEventListener("click", async(event)=>{
                //Verificar el elemento clickeado sea correcto
                if(event.target.classList.contains('btn-danger')){
                
                //Evitar recargar la página 
                    event.preventDefault()

                    const idjuguete = event.target.dataset.id

                    if(confirm("¿Está seguro de eliminar el registro?")){
                        eliminarJuguete(idjuguete)
                    }
                }
            })
            function eliminarJuguete(idjuguete){
                const datos = new FormData()
                datos.append("operacion","eliminar")
                datos.append("id",idjuguete)
                fetch('../../app/controllers/juguete.controller.php',{
                    method:'POST',
                    body: datos
                })
                    .then(response => response.json())
                    .then(data =>{
                        if(data.filas>0){
                            obtenerDatos()
                        }
                    })
                    .catch(e=>{
                        console.error(e)
                    })
            }
        })
    </script>
</body>
</html>