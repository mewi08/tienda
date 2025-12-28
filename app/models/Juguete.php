<?php
require_once 'Conexion.php';
class Juguete extends Conexion {
    private $conexion;

    public function __construct() {
        $this->conexion = parent::getConexion();
    }

    public function listar(){
        try{
            $sql = "
            SELECT id,nombre, descripcion, marca, precio, categoria, edadminima, stock, ingreso
            FROM juguetes
            ORDER BY id DESC";

            $consulta = $this->conexion->prepare($sql);

            $consulta->execute();

            return $consulta->fetchAll(PDO::FETCH_ASSOC);

        }catch( Exception $e){
            return [];
        }
    }

    public function agregar($registros=[]){
        try{
            $sql = "INSERT INTO juguetes
            (nombre, descripcion, marca, precio, categoria, edadminima, stock, ingreso)
            VALUES(?,?,?,?,?,?,?,?)";

            $consulta = $this->conexion->prepare($sql);

            $consulta->execute(
                array(
                    $registros['nombre'],
                    $registros['descripcion'],
                    $registros['marca'],
                    $registros['precio'],
                    $registros['categoria'],
                    $registros['edadminima'],
                    $registros['stock'],
                    $registros['ingreso'],
                )
            );
            return $this->conexion->lastInsertId();
            }catch( Exception $e){
                return -1;
            }

    }
}