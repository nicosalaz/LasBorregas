<?php

namespace App\Models;

use CodeIgniter\Model;

class VentasModel extends Model
{
    protected $table = 'venta';
    protected $primary_key = 'id_venta';
    protected $useAutoIncrement = true;
    protected $returnType        = 'object'; #EL TIPO DE RETORNO QUE TIENE
    protected $useTimestamps     = false; # NO RELLENA POR DEFECTO LOS NULOS
    protected $useSoftDeletes   = false;
    protected $allowedFields = [
        'fk_id_cliente', 'fecha', 'tipo_venta', 'estado'
    ];

    public function obtenerVenta($usuario)
    {
        $where = "'id_venta = '" . $usuario . "' AND estado = 1'";
        $venta = $this->where($where)->first();
        return $venta;
    }
    public function deleteVenta($id)
    {
        $db = db_connect(); // * Conectarse ala BD

        $query = 'UPDATE venta 
                    SET estado = 0 
                    WHERE id_venta = ' . $id; // * Ejecuta la consulta
        $result = $db->simpleQuery($query);
        return $result;
    }
    public function editVenta($id)
    {
        $db = db_connect(); // * Conectarse ala BD

        $query = 'UPDATE venta 
                    SET 
                     
                    WHERE id_venta = ' . $id; // * Ejecuta la consulta
    }
}
