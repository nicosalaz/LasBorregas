<?php

namespace App\Controllers;

use App\Models\ClientesModel;
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
        $cliente = $objCliente->obtenerCliente($usuario);
        $session = session();
        if (!$cliente) {
            $session->setFlashdata("error", "Error: este usuario no existe");
            return redirect()->to(base_url('/'));
        }
        if ($cliente->contrasena != $clave) {
            $session->setFlashdata("error", "Error: la clave es incorrecta");
            return redirect()->to(base_url('/'));
        }
        $session->cliente = $cliente;
        $dataBloque['bloques'] = $objBloque->getAllBloque();
        return view('Pages/admin', $dataBloque);
    }
    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('/'));
    }
}
