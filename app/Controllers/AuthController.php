<?php

namespace App\Controllers;

use App\Models\ClientesModel;
use App\Models\EmpleadoModel;
use Exception;
use App\Models\ApiModel;

class AuthController extends BaseController
{

    public function login()
    {
        $usuario = $this->request->getPost('usuario');
        $clave = $this->request->getPost('clave');
        $objCliente = new ClientesModel();
        $objBloque = new ApiModel();
        $objEmpleado = new EmpleadoModel();
        $cliente = $objCliente->obtenerUsuario($usuario);
        $empleado = $objEmpleado->obtenerEmpleado($usuario);
        $usuario = $cliente;
        $session = session();
        if (!$cliente) {
            if (!$empleado) {
                $session->setFlashdata("error", "Error: este usuario no existe");
                return redirect()->to(base_url('/'));
            } else {
                $usuario = $empleado;
            }
        }
        if ($usuario->clave != $clave) {
            $session->setFlashdata("error", "Error: la clave es incorrecta");
            return redirect()->to(base_url('/'));
        }
        $session->usuario = $usuario;
        $dataBloque['bloques'] = $objBloque->getAllBloque();
        return view('Pages/admin', $dataBloque);
    }
    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('/'));
    }
}
