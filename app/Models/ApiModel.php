<?php

namespace App\Models;

use CodeIgniter\Database\Query;
use CodeIgniter\Model;

class ApiModel extends Model
{

    public function getAllClientes()
    {
        $db = db_connect(); // * Conectarse ala BD

        $query = $db->query('SELECT * FROM cliente where estado = 1'); // * Ejecuta la consulta

        return $query; // * Regresa al modelo el objeto $data[]
    }
<<<<<<< HEAD

=======
>>>>>>> ab15dd98e68470dce952c3403dccfc36fd206d8e
    public function getAllVentas()
    {
        $db = db_connect(); // * Conectarse ala BD

        $query = $db->query('SELECT * FROM venta where estado = 1'); // * Ejecuta la consulta

        return $query; // * Regresa al modelo el objeto $data[]

    }

    public function getAllBloque()
    {
        $db = db_connect(); // * Conectarse ala BD

        $query = $db->query('SELECT * FROM bloque where estado = 1'); // * Ejecuta la consulta

        return $query; // * Regresa al modelo el objeto $data[]

    }
}
