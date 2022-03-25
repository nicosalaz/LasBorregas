<?php

namespace App\Controllers;

use App\Models\ApiModel;
use App\Models\ClientesModel;
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
    public function editCliente()
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
        if ($clienteModel->update($data)) {
            session()->setFlashdata("success", 'Actualizacion exitosa');
        } else {
            session()->setFlashdata("error", "No se pudo Actualizar");
        }
        return redirect()->to(base_url('/clientes'));
    }
}
