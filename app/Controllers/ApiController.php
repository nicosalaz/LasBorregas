<?php

namespace App\Controllers;

use App\Models\ApiModel;
use App\Models\ClientesModel;
use App\Models\VentasModel;
use App\Models\BloqueModel;
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
            'contrasena' => $this->request->getPost("contrasena")
        ];
        if ($clienteModel->insert($data)) {
            session()->setFlashdata("success", 'Agregado');
        } else {
            session()->setFlashdata("error", "No se pudo eliminar");
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
            'contrasena' => $this->request->getPost("contrasena")
        ];
        $clienteModel->set($data);
        $clienteModel->where('id_cliente', $id);
        if ($clienteModel->update()) {
            session()->setFlashdata("success", 'Actualización exitosa');
        } else {
            session()->setFlashdata("error", "No se pudo Actualizar");
        }
        return redirect()->to(base_url('/clientes'));
    }
    public function editPlantilla($id)
    {
        $clienteModel = new ClientesModel();
        $result['clientes'] = $clienteModel->getCliente($id);
        return view('Pages/editClientes', $result);
    }

    // *===================================INICIO DE VENTAS=========================================================================
    // *===================================INICIO DE VENTAS=========================================================================
    public function readVentas()
    {
        // * Instanciar modelo de la API
        $VentasModel = new ApiModel();

        // * manda a llamar la funcion getAllEmpleados(), esta funcion nos regresa el resultado de la consulta y lo guarda en la varaible $empleado
        $ventas['venta'] = $VentasModel->getAllVentas();
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
        $VentasModel = new VentasModel();
        $data = [
            'fk_id_cliente' => $this->request->getPost("fk_id_cliente"),
            'fecha' => $this->request->getPost("fecha"),
            'tipo_venta' => $this->request->getPost("tipo_venta"),
            'estado' => 1
        ];
        if ($VentasModel->insert($data)) {
            session()->setFlashdata("success", 'Agregado');
        } else {
            session()->setFlashdata("error", "No se pudo Agregar");
        }
        return redirect()->to(base_url('/venta'));
    }
    public function addPlantillaVenta()
    {
        $clientes = new ApiModel();
        $resultado['clientes'] = $clientes->getAllClientes();
        return view("Pages/addVentas", $resultado);
    }

    public function editVenta($id)
    {
        $ventasModel = new VentasModel();
        $data = [
            'fecha' => $this->request->getPost("fecha"),
            'tipo_venta' => $this->request->getPost("tipo_venta"),
            'estado' => 1
        ];
        $ventasModel->set($data);
        $ventasModel->where("id_venta", $id);
        if ($ventasModel->update()) {
            session()->setFlashdata("success", 'Actualizacion exitosa');
        } else {
            session()->setFlashdata("error", "No se pudo Actualizar");
        }
        return redirect()->to(base_url('/ventas'));
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
    // ===================================INICIO DE BLOQUE=========================================================================
    public function readBloque()
    {
        // * Instanciar modelo de la API
        $BloqueModel = new ApiModel();

        // * manda a llamar la funcion getAllEmpleados(), esta funcion nos regresa el resultado de la consulta y lo guarda en la varaible $empleado
        $bloque['bloque'] = $BloqueModel->getAllBloque();

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
    // *===================================INICIO DE BLOQUE=========================================================================
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
}
