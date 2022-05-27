<?php

namespace App\Models;

use CodeIgniter\Model;

class DetalleVenta extends Model
{

    public function venta($data)
    {
        $objBloque = new BloqueModel();
        $productos = $data['id_prod'];
        $cantidades = $data['cantidades'];
        $precios = $data['precios'];
        $fk_cliente = $data['fk_id_cliente'];
        $t_venta = $data['t_venta'];
        $fk_empleado = 5;
        $fecha = $data['fecha'];
        $total = $data['total'];
        if ($t_venta != "Linea") {
            $fk_empleado = $data['fk_id_empleado'];
        }
        //print_r($data['productos']);
        $this->db->transStrict(true);
        $this->db->transStart();

        $this->db->query("INSERT INTO venta (fk_id_cliente,fk_id_empleado,fecha,tipo_venta,total,estado) 
                            VALUES({$fk_cliente},{$fk_empleado},'{$fecha}','{$t_venta}','{$total}',1);");

        $this->db->query('SET @ID_VENTA = LAST_INSERT_ID();');

        for ($i = 0; $i < count($productos); $i++) {
            $this->db->query("INSERT INTO detalle_venta_bloque
                                (fk_id_bloque,fk_id_venta,cantidad,precio_venta)
                                 VALUES ({$productos[$i]},@ID_VENTA,{$cantidades[$i]},{$precios[$i]});");
            $objBloque->setStockProduct($productos[$i], $cantidades[$i]);
        }
        $this->db->transComplete();

        return $this->db->transStatus();
    }
}
