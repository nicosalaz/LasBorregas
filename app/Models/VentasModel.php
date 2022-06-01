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
        'fk_id_cliente', 'fk_id_empleado', 'fecha', 'tipo_venta', 'estado'
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

    public function ventaEmpleado($data)
    {
        $objBloque = new BloqueModel();
        $productos = $data['id_prod'];
        $cantidades = $data['cantidades'];
        $precios = $data['precios'];
        $fk_cliente = $data['fk_id_cliente'];
        $this->db->transStrict(false);
        $this->db->transStart();

        $this->db->query("INSERT INTO venta (id_venta,fk_id_cliente,fk_id_empleado,fecha,tipo_venta,total,estado) 
                            VALUES(null,{$fk_cliente},{$data['id_empleado']},'{$data['fecha']}',
                            '{$data['tipo_venta']}',{$data['total']},1);");

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

    public function venta($data)
    {
        $objBloque = new BloqueModel();
        $productos = $data['id_prod'];
        $cantidades = $data['cantidades'];
        $precios = $data['precios'];
        $fk_cliente = $data['fk_id_cliente'];
        $fk_empleado = $data['fk_id_empleado'];
        $tipo_venta = $data['tipo_venta'];
        $fecha = $data['fecha'];
        //print_r($data['productos']);
        if ($tipo_venta == "Linea") {
            $fk_empleado = "5";
        }
        $this->db->transStrict(false);
        $this->db->transStart();

        $this->db->query("INSERT INTO venta (id_venta,fk_id_cliente,fk_id_empleado,fecha,tipo_venta,estado) 
                            VALUES(null,{$fk_cliente},{$fk_empleado},{$fecha},{$tipo_venta},1);");

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

    public function bloquesVendidosOrdenados()
    {
        $db = db_connect();
        $query =    "SELECT b.id_bloque as id, b.blq_nombre as nombre,b.blq_tamano as tamano ,SUM(dvb.cantidad) as sumatoria
                        FROM venta as v INNER JOIN detalle_venta_bloque as dvb ON (v.id_venta =dvb.fk_id_venta)
                        INNER JOIN bloque as b on (b.id_bloque = dvb.fk_id_bloque)
                        GROUP by b.id_bloque
                        ORDER BY sumatoria DESC; ";
        $data = $db->query($query);
        return $data;
    }
    /*
    SELECT v.id_venta,c.cl_nombre, v.fecha, v.tipo_venta, v.total
FROM venta as v INNER JOIN cliente as c on(c.id_cliente = v.fk_id_cliente)
WHERE v.estado = 1;
    */
    public function ventasPorFecha()
    {
        $db = db_connect(); // * Conectarse ala BD

        $query = $db->query("SELECT v.id_venta,c.cl_nombre,c.id_cliente, v.fecha, v.tipo_venta, v.total
                            FROM venta as v INNER JOIN cliente as c on(c.id_cliente = v.fk_id_cliente) ;"); // * Ejecuta la consulta

        return $query; // * Regresa al modelo el objeto $data[]
    }
}
