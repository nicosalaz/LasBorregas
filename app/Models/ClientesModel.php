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
    public function editCliente($id)
    {
        $db = db_connect(); // * Conectarse ala BD

        $query = 'UPDATE cliente 
                    SET 
                     
                    WHERE id_cliente = ' . $id; // * Ejecuta la consulta
    }
}
