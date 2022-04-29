<?php

namespace App\Controllers;

use App\Models\ApiModel;

class Home extends BaseController
{
    public function index()
    {
        return view('auth/login');
    }
    public function view($page = 'admin')
    {
        //Este if checha si la vista existe, si no muesta un mensaje de error,
        // podemos diseñar una vista para que muestre el error, en lugar del error que muestra codeigniter
        if (!is_file(APPPATH . 'Views/pages/' . $page . '.php') && !is_file(APPPATH . 'Views/pages/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
        }

        //echo view('pages/head'); //carga el head de neustro HTML, aqui estan todos los links para CSS y scripts de JS 
        //echo view('pages/navbar'); // carga el munu de navegacion de nuestra app
        echo view('Pages/' . $page); // carga el contenido que tenemos en nuestra app
        //echo view('pages/footer'); // carga el pie de pagina de la app
    }
    public function viewRegister($page = 'registarUsuario')
    {
        //Este if checha si la vista existe, si no muesta un mensaje de error,
        // podemos diseñar una vista para que muestre el error, en lugar del error que muestra codeigniter
        if (!is_file(APPPATH . 'Views/auth/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
        }

        //echo view('pages/head'); //carga el head de neustro HTML, aqui estan todos los links para CSS y scripts de JS 
        //echo view('pages/navbar'); // carga el munu de navegacion de nuestra app
        echo view('auth/' . $page); // carga el contenido que tenemos en nuestra app
        //echo view('pages/footer'); // carga el pie de pagina de la app
    }
    public function home()
    {
        $objBloque = new ApiModel();
        $dataBloque['bloques'] = $objBloque->getAllBloque();
        return view('Pages/admin', $dataBloque);
    }
}
