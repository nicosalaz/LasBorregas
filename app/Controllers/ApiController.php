<?php

namespace App\Controllers;

use App\Models\ApiModel;
use App\Models\ClientesModel;
use App\Models\VentasModel;
use App\Models\BloqueModel;
use App\Models\DetalleVenta;
use App\Models\EmpleadoModel;
use App\Models\RolModel;
use CodeIgniter\Session\Session;

class ApiController extends BaseController
{
    /*
    * * Esta controlador tiene las funciones de una API ( Application Programming Interface)
    * * leer mas sobre API en https://www.ibm.com/cloud/learn/api o googlear
    **
    * * El cliente solicitara un servicio 
    * * nuestro controlador respodnera la peticion
    * * las funciones devuelcen un JSON como respuesta
    */


    // * Aqui crearemos nuestro CRUD que respondera las peticiones del cliente
    // * CREATE = INSERT = CREAR UN NUEVO REGISTRO EN BD
    // * READ = SELECT = HACER UNA CONSULTA EN LA BD
    // * UPDATE = == HACER UNA ACTUALIZACION DE UN REGISTRO EN LA BD
    // * DELETE = == BORRAR UN REGISTRO EN LA BD


    // *===================================INICIO DE CLIENTES=========================================================================
    // * esta funcion envia todos los empleados 
    public function readClientes()
    {
        // * Instanciar modelo de la API
        $clienteModel = new ApiModel();

        // * manda a llamar la funcion getAllEmpleados(), esta funcion nos regresa el resultado de la consulta y lo guarda en la varaible $empleado
        $cliente['clientes'] = $clienteModel->getAllClientes();

        // * regresar al cliente una respues en formato JSON
        return view("Pages/clientes", $cliente);
    }
    public function deleteCliente($id)
    {
        $clienteModel = new ClientesModel();
        $result = $clienteModel->deleteCliente($id);
        if ($result) {
            session()->setFlashdata("success", 'Eliminado');
        } else {
            session()->setFlashdata("error", "No se pudo eliminar");
        }
        return redirect()->to(base_url('/clientes'));
    }
    public function addCliente()
    {
        $clienteModel = new ClientesModel();
        $data = $this->request->getPost();
        /*[
            'cl_nombre' => $this->request->getPost("nombre"),
            'cl_apaterno' => $this->request->getPost("apaterno"),
            'cl_amaterno' => $this->request->getPost("amaterno"),
            'cl_calle' => $this->request->getPost("calle"),
            'cl_numb' => $this->request->getPost("numb"),
            'cl_codpostal' => $this->request->getPost("codpostal"),
            'cl_colonia' => $this->request->getPost("colonia"),
            'cl_lugar' => $this->request->getPost("lugar"),
            'cl_municipio' => $this->request->getPost("municipio"),
            'cl_telefono' => $this->request->getPost("telefono"),
            'estado' => 1,
            'usuario' => $this->request->getPost("usuario"),
            'contrasena' => $this->request->getPost("contrasena")
        ];*/
        $result = $clienteModel->addCliente($data);
        if ($result === false) {
            session()->setFlashdata("error", "No se pudo Agregar");
        } else {
            session()->setFlashdata("success", 'Agregado');
        }
        return redirect()->to(base_url('/clientes'));
    }
    public function editCliente($id)
    {
        $clienteModel = new ClientesModel();
        $data = [
            'cl_nombre' => $this->request->getPost("nombre"),
            'cl_apaterno' => $this->request->getPost("apaterno"),
            'cl_amaterno' => $this->request->getPost("amaterno"),
            'cl_calle' => $this->request->getPost("calle"),
            'cl_numb' => $this->request->getPost("numb"),
            'cl_codpostal' => $this->request->getPost("codpostal"),
            'cl_colonia' => $this->request->getPost("colonia"),
            'cl_lugar' => $this->request->getPost("lugar"),
            'cl_municipio' => $this->request->getPost("municipio"),
            'cl_telefono' => $this->request->getPost("telefono"),
            'estado' => 1,
            'usuario' => $this->request->getPost("usuario"),
            'clave' => $this->request->getPost("contrasena")
        ];
        $data['id_cliente'] = $id;
        $result = $clienteModel->updateCliente($data);
        if ($result === false) {
            session()->setFlashdata("error", "No se pudo Actualizar");
        } else {
            session()->setFlashdata("success", 'Actualización exitosa');
        }
        return redirect()->to(base_url('/clientes'));
    }
    public function editPlantilla($id)
    {
        $clienteModel = new ClientesModel();
        $result['clientes'] = $clienteModel->getCliente($id);
        return view('Pages/editClientes', $result);
    }
    public function getVentaCliente($id)
    {
        $ventas = new VentasModel();
        $ventas->where('fk_id_cliente', $id);
        $ventas->where('estado', 1);
        $resultado['ventas'] = $ventas->find();
        return view("Pages/getVentasCliente", $resultado);
    }
    public function getDetalleVenta($id)
    {
        $ventas = new VentasModel();
        $data['detalles'] = $ventas->getDetalleVenta($id);
        return view("Pages/getDetalleVentaCliente", $data);
    }

    public function ventaCliente()
    {
        $clienteModel = new ClientesModel();
        $data = $this->request->getPost();
        date_default_timezone_set("America/New_York");
        $fecha = date("Y-m-d");
        $data['id_cliente'] = session("usuario")->id_cliente;
        $data['tipoVenta'] = "Linea";
        $data['id_empleado'] = 3;
        $data['fecha'] = $fecha;
        $result = $clienteModel->ventaCliente($data);
        if ($result === false) {
            session()->setFlashdata("error", "No se pudo Agregar");
        } else {
            session()->setFlashdata("success", 'Agregado');
        }
        return redirect()->to(base_url('/home'));
        //print_r($data);

    }

    // *===================================INICIO DE VENTAS=========================================================================
    // *===================================INICIO DE VENTAS=========================================================================
    public function readVentas()
    {
        // * Instanciar modelo de la API
        $VentasModel = new ApiModel();
        // * manda a llamar la funcion getAllEmpleados(), esta funcion nos regresa el resultado de la consulta y lo guarda en la varaible $empleado
        $ventas['venta'] = $VentasModel->getAllVentas();

        // * regresar al cliente una respues en formato JSON
        return view("Pages/venta", $ventas);
    }

    public function deleteVenta($id)
    {
        $VentasModel = new VentasModel();
        $result = $VentasModel->deleteVenta($id);
        if ($result) {
            session()->setFlashdata("success", 'Eliminado');
        } else {
            session()->setFlashdata("error", "No se pudo eliminar");
        }
        return redirect()->to(base_url('/venta'));
    }

    public function addVentas()
    {
        $detVentasModel = new DetalleVenta();
        $data = $this->request->getPost();
        //print_r($data);
        $result = $detVentasModel->venta($data);
        if ($result === false) {
            session()->setFlashdata("error", "No se pudo Agregar");
        } else {
            session()->setFlashdata("success", 'Agregado');
        }
        return redirect()->to(base_url('/venta'));
    }

    public function addPlantillaVenta()
    {
        $clientes = new ApiModel();
        $empleadoModel = new EmpleadoModel();
        $resultado['clientes'] = $clientes->getAllClientes();
        $resultado['bloques'] = $clientes->getAllBloque();
        $resultado['empleados'] = $empleadoModel->getAllEmpleados();
        return view("Pages/addVentas", $resultado);
    }

    public function editVenta($id)
    {
        $ventasModel = new VentasModel();
        $data = [
            'fecha' => $this->request->getPost("fecha"),
            'tipo_venta' => $this->request->getPost("tipo_venta"),
            'fk_id_cliente' => $this->request->getPost("fk_id_cliente"),
            'estado' => 1
        ];
        $ventasModel->set($data);
        $ventasModel->where("id_venta", $id);
        if ($ventasModel->update()) {
            session()->setFlashdata("success", 'Actualizacion exitosa');
        } else {
            session()->setFlashdata("error", "No se pudo Actualizar");
        }
        return redirect()->to(base_url('/venta'));
    }
    public function editPlantillaVenta($id)
    {
        $ventasModel = new VentasModel();
        $clientes = new ApiModel();
        $ventasModel->where('id_venta', $id);
        $resultado['ventas'] = $ventasModel->find();
        $resultado['clientes'] = $clientes->getAllClientes();

        return view("Pages/editVenta", $resultado);
    }

    public function plantillaAddVentaEmpleado()
    {
        $clientesModel = new ClientesModel();
        $bloqueModelo = new BloqueModel();
        $clientesModel->where("estado = ", 1);
        $data['clientes'] = $clientesModel->findAll();
        $bloqueModelo->where("estado =", 1);
        $data['bloques'] = $bloqueModelo->findAll();
        return view("Pages/addVentaEmpleado", $data);
    }

    public function addVentaEmpleado()
    {
        $ventaModel = new VentasModel();
        date_default_timezone_set("America/New_York");
        $fecha = date("Y-m-d");
        $tipo_venta = "Mostrador";
        $id_empleado = session("usuario")->id_empleado;
        $data = $this->request->getPost();
        $data['fecha'] = $fecha;
        $data['tipo_venta'] = $tipo_venta;
        $data['id_empleado'] = $id_empleado;
        //print_r($data);
        $resultado = $ventaModel->ventaEmpleado($data);
        if ($resultado === false) {
            session()->setFlashdata("error", "No se pudo Agregar");
        } else {
            session()->setFlashdata("success", 'Agregado');
        }
        return redirect()->to(base_url('/empleados/agregar-venta'));
    }


    // ===================================INICIO DE BLOQUE=========================================================================
    public function readBloque()
    {
        // * Instanciar modelo de la API
        $bloqueModel = new ApiModel();

        // * manda a llamar la funcion getAllEmpleados(), esta funcion nos regresa el resultado de la consulta y lo guarda en la varaible $empleado
        $bloque['bloque'] = $bloqueModel->getAllBloque();

        // * regresar al cliente una respues en formato JSON
        return view("Pages/bloque", $bloque);
    }
    public function deleteBloque($id)
    {
        $BloqueModel = new BloqueModel();
        $result = $BloqueModel->deleteBloque($id);
        if ($result) {
            session()->setFlashdata("success", 'Eliminado');
        } else {
            session()->setFlashdata("error", "No se pudo eliminar");
        }
        return redirect()->to(base_url('/bloque'));
    }
    public function addBloque()
    {
        $BloqueModel = new BloqueModel();
        $data = [
            'blq_nombre' => $this->request->getPost("nombre"),
            'blq_precio_unitario' => $this->request->getPost("pUnitario"),
            'blq_precio_venta' => $this->request->getPost("pVenta"),
            'blq_tamano' => $this->request->getPost("dimension"),
            'estado' => 1,
            'blq_existencia' => $this->request->getPost("existencia")
        ];
        if ($BloqueModel->insert($data)) {
            session()->setFlashdata("success", 'Agregado');
        } else {
            session()->setFlashdata("error", "No se pudo agregar");
        }
        return redirect()->to(base_url('/bloque'));
    }
    public function editBloque($id)
    {
        $bloqueModel = new BloqueModel();
        $data = [
            'blq_nombre' => $this->request->getPost("nombre"),
            'blq_precio_unitario' => $this->request->getPost("pUnitario"),
            'blq_precio_venta' => $this->request->getPost("pVenta"),
            'blq_tamano' => $this->request->getPost("dimension"),
            'estado' => 1,
            'blq_existencia' => $this->request->getPost("existencia")
        ];
        $bloqueModel->set($data);
        $bloqueModel->where('id_bloque', $id);
        if ($bloqueModel->update()) {
            session()->setFlashdata("success", 'Actualizacion exitosa');
        } else {
            session()->setFlashdata("error", "No se pudo Actualizar");
        }
        return redirect()->to(base_url('/bloque'));
    }
    public function editPlantillaBloque($id)
    {
        $bloques = new BloqueModel();
        $resultado['bloques'] = $bloques->getBloque($id);
        return view("Pages/editBloque", $resultado);
    }
    public function plantillaAumentarExistencia($id)
    {
        $bloque = new BloqueModel();
        $resultado['bloques'] = $bloque->getBloque($id);
        return view("Pages/aumentarExistencia", $resultado);
    }
    public function aumentarExistencia($id)
    {
        $bloques = new BloqueModel();
        $bloques->where('id_bloque', $id);
        $datos['bloque'] = $bloques->find();
        foreach ($datos['bloque'] as $row) {
            $existencia = $row->blq_existencia;
        }
        $adicion = $this->request->getPost("adicion");
        $nuevaExistencia = $existencia + $adicion;
        $data = [
            'blq_existencia' => $nuevaExistencia
        ];
        $bloques->where('id_bloque', $id);
        $bloques->set($data);
        $bloques->update();
        return redirect()->to(base_url('/bloque'));
    }

    // ===================================INICIO DE EMPLEADO=========================================================================

    public function getPlantillaEmpleados()
    {
        $empleadoModel = new EmpleadoModel();
        $rolModel = new RolModel();
        $data['empleados'] = $empleadoModel->getAllEmpleadosGeneral();
        return view('Pages/empleados', $data);
    }

    public function getPlantillaAddEmpleado()
    {
        $rolModel = new RolModel();
        $data['roles'] = $rolModel->getRolesEmpleados();
        return view('Pages/addEmpleado', $data);
    }

    public function addEmpleado()
    {
        $empleadoModel = new EmpleadoModel();
        $data = $this->request->getPost();
        /*$data = [
            'nombre_empleado' => $this->request->getPost("nombre_empleado"),
            'apellido_empleado' => $this->request->getPost("apellido_empleado"),
            'fecha_ingreso' => $this->request->getPost("fecha_ingreso"),
            'fecha_egreso' => null,
            'telefono' => $this->request->getPost("telefono"),
            'nombre_usuario' => $this->request->getPost("nombre_usuario"),
            'clave' => $this->request->getPost("contrasena"),
        ];*/
        $resultado = $empleadoModel->addEmpleado($data);
        if ($resultado === false) {
            session()->setFlashdata("error", "No se pudo Insertar");
        } else {
            session()->setFlashdata("success", "Se agrego exitosamente");
        }
        return redirect()->to(base_url('/empleados'));
    }

    public function eliminarEmpleado($id)
    {
        date_default_timezone_set("America/New_York");
        $fecha = date("Y-m-d");
        $empleadoModel = new EmpleadoModel();
        $empleadoModel->set(["estado_actividad" => 0, "fecha_egreso" => $fecha])
            ->where("id_empleado = ", $id);
        if ($empleadoModel->update()) {
            session()->setFlashdata("success", "Se eliminó exitosamente");
        } else {
            session()->setFlashdata("error", "No se pudo eliminar");
        }
        return redirect()->to(base_url('/empleados'));
    }

    public function plantillaEditEmpleado($id)
    {
        $empleadoModel = new EmpleadoModel();
        $rolModel = new RolModel();
        $data['empleado'] = $empleadoModel->select("*")
            ->join("usuario", "usuario.idUsuario = empleado.fkiduser")
            ->join("rol", "rol.id_rol = empleado.fkidrol")
            ->where("id_empleado =", $id)
            ->find();
        foreach ($data['empleado'] as $key) {
            $rol = $key->fkidrol;
        }
        $data['roles'] = $rolModel->where([
            "nombre_rol != " => 'CLIENTE',
            "id_rol !=" => $rol
        ])
            ->findAll();
        return view("Pages/editEmpleado", $data);
    }

    public function editEmpleado($id)
    {
        $empleadoModel = new EmpleadoModel();
        $data = $this->request->getPost();
        $data['id_empleado'] = $id;
        //print_r($data);
        $resultado = $empleadoModel->editEmpleado($data);
        if ($resultado === false) {
            session()->setFlashdata("error", "No se pudo Actualizar");
        } else {
            session()->setFlashdata("success", 'Actualizado');
        }
        return redirect()->to(base_url('/empleados'));
    }



    //########################################### REPORTES ###########################################
    public function getReportesPlantilla()
    {
        return view('Pages/reportes');
    }
    public function getReporteBloquesVendidos()
    {
        $ventaModel = new VentasModel();
        $data['bloquesVendidos'] = $ventaModel->bloquesVendidosOrdenados();
        return view('Pages/bloquesVendidos', $data);
    }
    public function getReporteClientesVentas()
    {
        $clientesModel = new ClientesModel();
        $data['clientesVentas'] = $clientesModel->clientesVentasOrdenadas();
        return view('Pages/clientesVentas', $data);
    }
    public function getReporteVentasPorFecha()
    {
        $ventaModel = new VentasModel();
        $data['ventasPorFecha'] = $ventaModel->ventasPorFecha();
        return view('Pages/ventasPorFecha', $data);
    }
    public function getReporteVentasPorCliente()
    {
        $ventaModel = new VentasModel();
        $clienteModel = new ClientesModel();
        $data['ventasPorCliente'] = $ventaModel->ventasPorFecha();
        $data['clientes'] = $clienteModel->findAll();
        return view('Pages/ventasPorCliente', $data);
    }
}
