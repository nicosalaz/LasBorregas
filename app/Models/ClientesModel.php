<?php

namespace App\Models;

use CodeIgniter\Model;

class ClientesModel extends Model
{
    protected $table = 'cliente';
    protected $primary_key = 'id_cliente';
    protected $useAutoIncrement = true;
    protected $returnType        = 'object'; #EL TIPO DE RETORNO QUE TIENE
    protected $useTimestamps     = false; # NO RELLENA POR DEFECTO LOS NULOS
    protected $useSoftDeletes   = false;
    protected $allowedFields = [
        'cl_nombre', 'cl_apaterno', 'cl_amaterno', 'cl_calle', 'cl_numb',
        'cl_codpostal', 'cl_colonia', 'cl_lugar', 'cl_municipio', 'cl_telefono',
        'estado', 'usuario', 'contrasena'
    ];

    public function obtenerCliente($usuario)
    {
        $where = "usuario = '" . $usuario . "' AND estado = 1";
        $cliente = $this->where($where)->first();
        return $cliente;
    }
    public function deleteCliente($id)
    {
        $db = db_connect(); // * Conectarse ala BD

        $query = 'UPDATE cliente 
                    SET estado = 0 
                    WHERE id_cliente = ' . $id; // * Ejecuta la consulta
        $result = $db->simpleQuery($query);
        return $result;
    }
    public function getCliente($id)
    {
        $db = db_connect(); // * Conectarse ala BD

        $query = $db->query("SELECT * FROM cliente where id_cliente = " . $id); // * Ejecuta la consulta

        return $query; // * Regresa al modelo el objeto $data[]
    }
    public function clientesVentasOrdenadas()
    {
        $db = db_connect(); // * Conectarse ala BD

        $query = $db->query("SELECT c.id_cliente as id,c.cl_nombre as nombre,COUNT(v.fk_id_cliente) as sumatoria 
                            FROM venta as v INNER JOIN cliente as c ON (v.fk_id_cliente= c.id_cliente) 
                            WHERE v.estado = 1 
                            AND c.estado = 1 
                            GROUP by c.id_cliente 
                            ORDER BY sumatoria DESC;"); // * Ejecuta la consulta

        return $query; // * Regresa al modelo el objeto $data[]
    }
}
