<?php

require_once '../models/Juguete.php';
$juguete = new Juguete();

if(isset($_POST['operacion'])){
    switch($_POST['operacion']){
        case 'listar':
            $registros = $juguete->listar() ;
            echo json_encode($registros);
            break;
        case 'registrar':

            break;
    }

}