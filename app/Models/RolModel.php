<?php

namespace App\Models;

use CodeIgniter\Model;

class RolModel extends Model
{
    protected $table = 'rol';
    protected $primary_key = 'id_rol';
    protected $useAutoIncrement = true;
    protected $returnType        = 'object'; #EL TIPO DE RETORNO QUE TIENE
    protected $useTimestamps     = false; # NO RELLENA POR DEFECTO LOS NULOS
    protected $useSoftDeletes   = false;
    protected $allowedFields = [
        'nombre_rol'
    ];

    public function getRolesEmpleados()
    {
        $this->where("nombre_rol !=", "CLIENTE");
        $result = $this->findAll();
        return $result;
    }
}
