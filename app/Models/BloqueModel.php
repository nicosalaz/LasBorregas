<?php

namespace App\Models;

use CodeIgniter\Model;

class BloqueModel extends Model
{
    protected $table = 'bloque';
    protected $primary_key = 'id_bloque';
    protected $useAutoIncrement = true;
    protected $returnType        = 'object'; #EL TIPO DE RETORNO QUE TIENE
    protected $useTimestamps     = false; # NO RELLENA POR DEFECTO LOS NULOS
    protected $useSoftDeletes   = false;
    protected $allowedFields = [
        'blq_nombre', 'blq_precio_unitario', 'blq_precio_venta', 'blq_tamano', 'estado', 'blq_existencia'
    ];

    public function obtenerBloque($usuario)
    {
        $where = "'id_bloque = '" . $usuario . "' AND estado = 1'";
        $bloque = $this->where($where)->first();
        return $bloque;
    }
    public function deleteBloque($id)
    {
        $db = db_connect(); // * Conectarse ala BD

        $query = 'UPDATE bloque 
                    SET estado = 0 
                    WHERE id_bloque = ' . $id; // * Ejecuta la consulta
        $result = $db->simpleQuery($query);
        return $result;
    }
    public function getBloque($id)
    {
        $db = db_connect(); // * Conectarse ala BD

        $query = $db->query("SELECT * FROM bloque where id_bloque = " . $id); // * Ejecuta la consulta

        return $query; // * Regresa al modelo el objeto $data[]
    }

    public function setStockProduct($id, $cantidad)
    {
        $db = db_connect(); // * Conectarse ala BD
        $bloque = $this->getBloque($id);
        foreach ($bloque->getResult() as $row) {
            $oldCantidad = $row->blq_existencia;
        }
        $newCantidad = $oldCantidad - $cantidad;
        $query = 'UPDATE bloque 
                    SET blq_existencia = ' . $newCantidad . ' 
                    WHERE id_bloque = ' . $id; // * Ejecuta la consulta
        $db->query($query);
    }
}
