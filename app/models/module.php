<?php
namespace Models;
use Core\Model;

class Module extends Model
{

    public function __construct(){
        parent::__construct();
    }

    public function getModules(){
        $sql = "SELECT * FROM modules";
        return $this->getAll($sql);

    }

}