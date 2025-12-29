<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div>
             <h3>Edición de juguetes</h3>
             <p>Complete el formulario solicitado para editar un nuevo elemento</p>
              <a href="./index.php" class="btn btn-sm btn-outline-success">Listar</a>
        </div>

        <div>
        <form action="" id="formulario-editar">
            <div class="card">
                <div class="card-header">Formulario</div>
                <div class="card-body">
                    <!-- formulario de registro -->
                    <div class="form-floating mb-2">
                        <input type="text" id="nombre" class="form-control" required>
                        <label for="nombre" id="form-label">Nombre</label>
                    </div>

                    <div class="form-floating mb-2">
                        <input type="text" id="descripcion" class="form-control" required>
                        <label for="descripcion" id="form-label">Descripción</label>
                    </div>

                    <!-- Tiene 12 columnas -->
                <div class="row g-2">
                    <div class="col-md-6 g-2">
                        <div class="form-floating mb-2">
                        <select name="" id="marca" class="form-select" required>
                            <option value="">Selecciona</option>
                            <option value="LEGO">LEGO</option>
                            <option value="Mattel">Mattel</option>
                            <option value="Hasbro">Hasbro</option>
                            <option value="Nerf">Nerf</option>
                            <option value="VTech">VTech</option>
                            <option value="WowWee">WowWee</option>
                            <option value="Fisher-Price">Fisher-Price</option>
                        </select>
                            <label for="marca">Marca</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-2">
                            <select name="categoria" id="categoria" class="form-select" required>
                                <option value="">Selecciona</option>
                                <option value="Muñecos y figuras">Muñecos y figuras</option>
                                <option value="Construcción y creatividad">Construcción y creatividad</option>
                                <option value="Juegos educativos">Juegos educativos</option>
                                <option value="Juegos de mesa">Juegos de mesa</option>
                                <option value="Vehículos y pistas">Vehículos y pistas</option>
                                <option value="Juguetes tecnológicos">Juguetes tecnológicos</option>
                                <option value="Juguetes de acción">Juguetes de acción</option>

                            </select>
                            <label for="categoria" class="form-label">Categoría</label>
                        </div>
                    </div>
                </div> <!-- row -->

                <div class="row g-2">
                    <div class="col-md-6 g-2">
                        <div class="form-floating mb-2">
                            <input type="number" min="1" id="precio" class="form-control" required>
                            <label for="precio" class="form-label">Precio</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-2">
                            <input type="number" min="1" id="edadminima" class="form-control" required>
                            <label for="edadminima" class="form-label">Edad Mínima</label>
                        </div>
                    </div>
                </div>  <!-- row -->

                <div class="row g-2">
                    <div class="col-md-6 g-2">
                        <div class="form-floating mb-2">
                            <input type="number" min="1" id="stock" class="form-control" required>
                            <label for="stock" class="form-label">Stock</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-2">
                            <input type="date" id="ingreso" class="form-control" required>
                            <label for="ingreso" id="form-label">Fecha ingreso</label>
                        </div>
                    </div>
                </div> <!-- row -->                    
                   
                </div>
                <div class="card-footer text-end">
                    <button class="btn btn-info" type="submit">Actualizar</button>
                    <button class="btn btn-outline-secondary" type="reset">Cancelar</button>
                </div>
            </div>
        </form>
        </div>
    </div>
    <script>
       document.addEventListener("DOMContentLoaded",function(){
        let parametro = new URLSearchParams(location.search)
        let id = parametro.get('id')
        
        function buscarJuguete(idbuscado){
            const datos = new FormData()
            datos.append("operacion", "buscarPorId")
            datos.append("id",idbuscado)

            fetch('../../app/controllers/juguete.controller.php',{
                method: 'POST',
                body:datos
            })
                .then(response => response.json())
                .then(data =>{
                    document.querySelector("#nombre").value= data[0].marca;
                    document.querySelector("#descripcion").value= data[0].descripcion
                    document.querySelector("#marca").value= data[0].marca
                    document.querySelector("#precio").value= data[0].precio
                    document.querySelector("#categoria").value= data[0].categoria
                    document.querySelector("#edadminima").value= data[0].edadminima
                    document.querySelector("#stock").value= data[0].stock
                    document.querySelector("#ingreso").value= data[0].ingreso

                })
                .catch(e=>{
                    console.error(e)
                })
        }

        buscarJuguete(id)


        })
    </script>
</body>
</html>