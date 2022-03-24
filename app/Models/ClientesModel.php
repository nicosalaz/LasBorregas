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
    protected $useSoftDeletes   = true;

    public function obtenerCliente($usuario)
    {
        $cliente = $this->where('usuario', $usuario)->first();
        return $cliente;
    }
    public function deleteCliente($id)
    {
        $db = db_connect(); // * Conectarse ala BD

        $query = $db->query('UPDATE cliente 
                            SET estado = 0 
                            WHERE id_cliente = ' . $id); // * Ejecuta la consulta
        return $query;
    }
}
