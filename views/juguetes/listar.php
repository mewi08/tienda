<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar</title>
    <!-- estilos de boostrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
</head>
<body>
    <div class="container mt-3">
        <h1>Listar Juguetes</h1>
        <a href="./crear.php" class="btn btn-sm btn-primary">Registrar</a>
        <hr>
        <table class="table table-striped" id="tabla-juguetes">
            <thead>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Marca</th>
                <th>Precio</th>
                <th>Categoria</th>
                <th>Edad Mínima</th>
                <th>Stock</th>
                <th>Fecha Ingreso</th>
                <th>Operaciones</th>
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
                    data.forEach(element => {
                        tabla.innerHTML +=`
                        <tr>
                            <td> ${element.id} </td>
                            <td> ${element.nombre} </td>
                            <td> ${element.descripcion} </td>
                            <td> ${element.marca} </td>
                            <td> ${element.precio} </td>
                            <td> ${element.categoria} </td>
                            <td> ${element.edadminima} </td>
                            <td> ${element.stock} </td>
                            <td> ${element.ingreso} </td>
                            <td>
                                <a href='#' class='btn btn-sm btn-danger'>Eliminar</a>
                                <a href='#' class='btn btn-sm btn-info'>Editar</a>
                            </td>
                        </tr>`;
                    });
                })
            } obtenerDatos();
        })
    </script>
</body>
</html>