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
    //protected $useSoftDeletes   = false;
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
    public function clienteDeVenta($id)
    {
        $db = db_connect();
        $query = "SELECT id_cliente from venta where id_venta = " . $id;
    }
    public function venta($data)
    {
        $objBloque = new BloqueModel();
        $productos = $data['id_prod'];
        $cantidades = $data['cantidades'];
        $precios = $data['precios'];
        $fk_cliente = $data['fk_id_cliente'];
        $tipo_venta = $data['tipo_venta'];
        $fecha = $data['fecha'];
        //print_r($data['productos']);
        $this->db->transStrict(false);
        $this->db->transStart();

        $this->db->query("INSERT INTO venta (id_venta,fk_id_cliente,fecha,tipo_venta,estado) 
                            VALUES(null,{$fk_cliente},{$fecha},{$tipo_venta},1);");

        $this->db->query('SET @ID_VENTA = LAST_INSERT_ID();');

        for ($i = 0; $i < count($productos); $i++) {
            $this->db->query("INSERT INTO detalle_venta_bloque
                                (id_det_vta_blq,fk_id_bloque,fk_id_venta,cantidad,precio_venta)
                                 VALUES (null,{$productos[$i]},@ID_VENTA,{$cantidades[$i]},{$precios[$i]});");
            $objBloque->setStockProduct($productos[$i], $cantidades[$i]);
        }
        $this->db->transComplete();

        return $this->db->transStatus();
    }

    public function getDetalleVenta($id)
    {
        $db = db_connect();
        $query =    "SELECT *
                    FROM venta v inner join detalle_venta_bloque dvb ON(v.id_venta = dvb.fk_id_venta)
                    INNER JOIN bloque b ON(dvb.fk_id_bloque = b.id_bloque)
                    WHERE v.id_venta = " . $id;
        $data = $db->query($query);
        return $data;
    }
}
