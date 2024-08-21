<?php
use Core\Controller;
use Models\Module;
require_once 'app/models/module.php';

class ModuleController extends Controller
{   
    private $modulesmodel;
    public function __construct()
    {
        $this->modulesmodel = new Module();
    }
    public function index()
    {   
        $data =  $this->modulesmodel->getAllMoudules();
        $this->view('module/index', $data);
    }
}