<?php
require_once 'Conexion.php';
class Juguete extends Conexion {
    private $conexion;

    public function __construct() {
        $this->conexion = parent::getConexion();
    }

    public function listar(): array{
        try{
            $sql = "
            SELECT id,nombre, descripcion, marca, precio, categoria, edadminima, stock, ingreso
            FROM juguetes WHERE estado=1
            ORDER BY id DESC";

            $consulta = $this->conexion->prepare($sql);

            $consulta->execute();

            return $consulta->fetchAll(PDO::FETCH_ASSOC);

        }catch( Exception $e){
            return [];
        }
    }

    public function agregar($registro=[]):int{
        try{
            $sql = "INSERT INTO juguetes
            (nombre, descripcion, marca, precio, categoria, edadminima, stock, ingreso,estado)
            VALUES(?,?,?,?,?,?,?,?,?)";

            $consulta = $this->conexion->prepare($sql);

            $consulta->execute(
                array(
                    $registro['nombre'],
                    $registro['descripcion'],
                    $registro['marca'],
                    $registro['precio'],
                    $registro['categoria'],
                    $registro['edadminima'],
                    $registro['stock'],
                    $registro['ingreso'],
                    $registro['estado']=1,
                )
            );
            return $this->conexion->lastInsertId();
            }catch( Exception $e){
                return -1;
            }

    }
    public function eliminar($id): int{
        try{
            $sql="
            UPDATE juguetes set
                estado = 0
            WHERE id = ?";

            $consulta = $this->conexion->prepare($sql);
            $consulta->execute(array($id));
            return $consulta->rowCount();
        }catch(Exception $e){
            return -1;
        }
    }
    public function actualizar($registro=[]): int{
        try{
            $sql="
            UPDATE juguetes set
                nombre = ?, 
                descripcion = ?, 
                marca = ?, 
                precio = ?, 
                categoria = ?, 
                edadminima = ?, 
                stock = ?, 
                ingreso = ?,
                estado = 1
                updated = now()
            WHERE id = ?
            ";
            $consulta= $this->conexion->prepare($sql);
            $consulta->execute(array(
                $registro["nombre"],
                $registro["descripcion"],
                $registro["marca"],
                $registro["precio"],
                $registro["categoria"],
                $registro["edadminima"],
                $registro["stock"],
                $registro["ingreso"],
                $registro["id"],
            )); 
            return $consulta->rowCount();
        }catch(Exception $e){
            return -1;
        }
    }
    public function buscarPorId($id):array{
        try{
            $sql="SELECT * FROM juguetes WHERE estado = 1 AND id = ?";
            $consulta= $this->conexion->prepare($sql);
            $consulta->execute(array($id));
           return $consulta ->fetchAll(PDO::FETCH_ASSOC);
        }catch(Exception $e){
            die($e->getMessage());
        }
    }

    public function buscarPorMarca($marca): array{
        try{
            $sql= "SELECT * FROM juguetes WHERE estado = 1 AND marca = ?";

            $consulta = $this->conexion->prepare($sql);

            $consulta->execute(array($marca));

            return $consulta ->fetchAll(PDO::FETCH_ASSOC);
        }catch(Exception $e){
            die($e->getMessage());
        }
    }
    public function buscarPorCategoria($categoria):array{
        try{
            $sql="SELECT * FROM juguetes WHERE estado = 1 AND categoria = ?";

            $consulta = $this->conexion->prepare($sql);

            $consulta->execute(array($categoria));

            return $consulta->fetchAll(PDO::FETCH_ASSOC);

        }catch(Exception $e){
            die($e->getMessage());
        }
    }
}