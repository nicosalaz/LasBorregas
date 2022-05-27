<?php

namespace App\Models;

use CodeIgniter\Database\Query;
use CodeIgniter\Model;

class ApiModel extends Model
{

    public function getAllClientes()
    {
        $db = db_connect(); // * Conectarse ala BD

        $query = $db->query('SELECT *
                            FROM cliente as c INNER JOIN usuario as u on(u.idUsuario = c.fkidusuario)
                            WHERE c.estado = 1;'); // * Ejecuta la consulta

        return $query; // * Regresa al modelo el objeto $data[]
    }
    public function getAllVentas()
    {
        $db = db_connect(); // * Conectarse ala BD

        $query = $db->query('SELECT * 
                            FROM venta , cliente 
                            where cliente.id_cliente = venta.fk_id_cliente
                            and cliente.estado = 1
                            and venta.estado = 1'); // * Ejecuta la consulta

        return $query; // * Regresa al modelo el objeto $data[]

    }

    public function getAllBloque()
    {
        $db = db_connect(); // * Conectarse ala BD

        $query = $db->query('SELECT * FROM bloque where estado = 1'); // * Ejecuta la consulta

        return $query; // * Regresa al modelo el objeto $data[]

    }
}
