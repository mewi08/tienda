<?php

require_once '../models/Juguete.php';
$juguete = new Juguete();

if(isset($_POST['operacion'])){
    switch($_POST['operacion']){
        case 'listar':
            $registros = $juguete->listar() ;
            echo json_encode($registros);
            break;
        case 'agregar':
            $datos=[
                'nombre'=> $_POST['nombre'],
                'descripcion'=> $_POST['descripcion'],
                'marca'=> $_POST['marca'],
                'precio'=> $_POST['precio'],
                'categoria'=> $_POST['categoria'],
                'edadminima'=> $_POST['edadminima'],
                'stock'=> $_POST['stock'],
                'ingreso'=> $_POST['ingreso']
            ];
            $idobtenido = $juguete->agregar($datos) ;
            echo json_encode(['id'=>$idobtenido]);
            break;
    }

}