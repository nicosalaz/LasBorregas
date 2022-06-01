<?php

namespace App\Models;

use CodeIgniter\Model;

class EmpleadoModel extends Model
{
    protected $table = 'empleado';
    protected $primary_key = 'id_empleado';
    protected $useAutoIncrement = true;
    protected $returnType        = 'object'; #EL TIPO DE RETORNO QUE TIENE
    protected $useTimestamps     = false; # NO RELLENA POR DEFECTO LOS NULOS
    protected $useSoftDeletes   = false;
    protected $allowedFields = [
        'nombre_empleado', 'apellido_empleado', 'fecha_ingreso',
        'fecha_egreso', 'telefono', 'estado_actividad', 'fkidrol', 'fkiduser'
    ];

    public function obtenerEmpleado($usuario)
    {
        $empleado = $this->select("*")
            ->join("usuario", "usuario.idUsuario = empleado.fkiduser")
            ->where(["usuario.nombre_usuario = " => $usuario, "empleado.estado_actividad = " => '1'])->first();
        return $empleado;
    }
    public function getAllEmpleados()
    {
        $this->where(["estado_actividad = " => 1, "fkidrol" => 2]);
        $empleados = $this->findAll();
        return $empleados;
    }
    public function getAllEmpleadosGeneral()
    {
        $resultado = $this->db->query("SELECT * 
                                    FROM empleado as e inner join usuario as u on (e.fkiduser = u.idUsuario)
                                    inner join rol as r on (e.fkidrol = r.id_rol)
                                    where e.estado_actividad = 1");
        return $resultado;
    }
    public function addEmpleado($data)
    {


        //print_r($data['productos']);
        $this->db->transStrict(true);
        $this->db->transStart();

        $this->db->query("INSERT INTO usuario (nombre_usuario,clave) 
                            VALUES('{$data['nombre_usuario']}','{$data['contrasena']}');");

        $this->db->query('SET @ID_USUARIO = LAST_INSERT_ID();');

        $this->db->query("INSERT INTO empleado(nombre_empleado,apellido_empleado,fecha_ingreso,
                            fecha_egreso,telefono,estado_actividad,fkidrol,fkiduser) 
                            VALUES('{$data['nombre_empleado']}','{$data['apellido_empleado']}',
                                    '{$data['fecha_ingreso']}',null,'{$data['telefono']}',1,
                                    '{$data['fkidrol']}',@ID_USUARIO);");

        $this->db->transComplete();

        return $this->db->transStatus();
    }

    public function editEmpleado($data)
    {
        $query = $this->db->query("SELECT fkiduser
                                    from empleado 
                                    where id_empleado = {$data['id_empleado']}");
        $idUsuario = 0;
        foreach ($query->getResult() as $row) {
            $idUsuario = $row->fkiduser;
        }

        //print_r($data['productos']);
        $this->db->transStrict(true);
        $this->db->transStart();

        $this->db->query("UPDATE usuario SET nombre_usuario = '{$data['nombre_usuario']}',
                                clave = '{$data['contrasena']}'
                            WHERE idUsuario = {$idUsuario}");

        $this->db->query('SET @ID_USUARIO = LAST_INSERT_ID();');

        $this->db->query("UPDATE empleado SET nombre_empleado = '{$data['nombre_empleado']}'
                                            ,apellido_empleado = '{$data['apellido_empleado']}',
                                            fecha_ingreso = '{$data['fecha_ingreso']}',
                                            telefono = '{$data['telefono']}'
                                            WHERE id_empleado = {$data['id_empleado']}");

        $this->db->transComplete();

        return $this->db->transStatus();
    }
}
