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
        'estado', 'fkidrol', 'fkidusuario'
    ];

    public function obtenerCliente($usuario)
    {
        $where = "usuario = '" . $usuario . "' AND estado = 1";
        $cliente = $this->where($where)->first();
        return $cliente;
    }
    public function obtenerUsuario($usuario)
    {
        $cliente = $this->select("*")
            ->join("usuario", "usuario.idUsuario = cliente.fkidusuario")
            ->where(["usuario.nombre_usuario = " => $usuario, "cliente.estado = " => '1'])->first();
        /*
        $db = db_connect(); // * Conectarse ala BD

        $query = $db->query("SELECT * 
                            FROM usuario as u inner join cliente as c on(u.idUsuario = c.fkidusuario) 
                            where u.nombre_usuario = '" . $usuario . "'"); // * Ejecuta la consulta

        return $query; // * Regresa al modelo el objeto $data[]*/
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
    public function getCliente($id)
    {
        $db = db_connect(); // * Conectarse ala BD

        $query = $db->query("SELECT *
                            FROM cliente as c INNER JOIN usuario as u on(u.idUsuario = c.fkidusuario)
                            WHERE c.estado = 1
                            AND id_cliente = " . $id); // * Ejecuta la consulta

        return $query; // * Regresa al modelo el objeto $data[]
    }
    public function clientesVentasOrdenadas()
    {
        $db = db_connect(); // * Conectarse ala BD

        $query = $db->query("SELECT c.id_cliente as id,c.cl_nombre as nombre,COUNT(v.fk_id_cliente) as sumatoria 
                            FROM venta as v INNER JOIN cliente as c ON (v.fk_id_cliente= c.id_cliente) 
                            GROUP by c.id_cliente 
                            ORDER BY sumatoria DESC;"); // * Ejecuta la consulta

        return $query; // * Regresa al modelo el objeto $data[]
    }
    public function addCliente($data)
    {
        //print_r($data['productos']);
        $this->db->transStrict(true);
        $this->db->transStart();

        $this->db->query("INSERT INTO usuario (nombre_usuario,clave) 
                            VALUES('{$data['usuario']}','{$data['contrasena']}');");

        $this->db->query('SET @ID_USUARIO = LAST_INSERT_ID();');

        $this->db->query("INSERT INTO cliente(cl_nombre,cl_apaterno,cl_amaterno,
                            cl_calle,cl_numb,cl_codpostal,cl_colonia,cl_lugar,cl_municipio,
                            cl_telefono,estado,fkidrol,fkidusuario) 
                            VALUES('{$data['nombre']}','{$data['apaterno']}','{$data['amaterno']}',
                            '{$data['calle']}','{$data['numb']}','{$data['codpostal']}','{$data['colonia']}'
                            ,'{$data['lugar']}','{$data['municipio']}','{$data['telefono']}',1,3,@ID_USUARIO);");

        $this->db->transComplete();

        return $this->db->transStatus();
    }
    public function updateCliente($data)
    {
        $query = $this->db->query("SELECT fkidusuario 
                                    from cliente 
                                    where id_cliente = {$data['id_cliente']}");
        $idUsuario = 0;
        foreach ($query->getResult() as $row) {
            $idUsuario = $row->fkidusuario;
        }
        //print_r($data['productos']);
        $this->db->transStrict(true);
        $this->db->transStart();

        $this->db->query("UPDATE usuario SET nombre_usuario = '{$data['usuario']}' ,
                        clave = '{$data['clave']}' WHERE  idUsuario = '{$idUsuario}'");

        //$this->db->query('SET @ID_USUARIO = LAST_INSERT_ID();');

        $this->db->query("UPDATE cliente SET cl_nombre='{$data['cl_nombre']}',cl_apaterno='{$data['cl_apaterno']}',
                        cl_amaterno='{$data['cl_amaterno']}',cl_calle='{$data['cl_calle']}',cl_numb='{$data['cl_numb']}'
                        ,cl_codpostal='{$data['cl_codpostal']}',cl_colonia='{$data['cl_colonia']}',cl_lugar='{$data['cl_lugar']}',
                        cl_municipio='{$data['cl_municipio']}',cl_telefono='{$data['cl_telefono']}',
                        estado = 1
                        WHERE id_cliente = {$data['id_cliente']}");
        $this->db->transComplete();

        return $this->db->transStatus();
    }

    public function ventaCliente($data)
    {
        $objBloque = new BloqueModel();
        $productos = $data['id'];
        $cantidades = $data['canti'];
        $precios = $data['price'];
        //print_r($data['productos']);
        $this->db->transStrict(true);
        $this->db->transStart();

        $this->db->query("INSERT INTO venta (fk_id_cliente,fk_id_empleado,fecha,tipo_venta,total,estado) 
                            VALUES({$data['id_cliente']},{$data['id_empleado']},'{$data['fecha']}',
                            '{$data['tipoVenta']}','{$data['total']}',1);");

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
