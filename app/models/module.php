<?php
namespace Models;
use Core\Model;
// require_once 'core/Model.php';
class Module extends Model
{

    public function __construct(){
        parent::__construct();
    }

    public function getModules(){
        $sql = "SELECT module_id, module_name FROM Modules";
        return $this->getAll($sql);

    }

    public function getAllMoudules(){
        $sql = "SELECT * FROM Modules";
        return $this->getAll($sql);
    }

    public function createModule(array $data){
        $sql = "INSERT INTO Modules (module_name,description) VALUES (:module_name, :description)";
        $this->db->bind(':module_name', $data['module_name']);
        $this->db->bind(':description', $data['description']);
        return $this->db->execute();
    }

    //write to table QuestionModules with question_id and module_id values 
    public function createQuestionModule(int $question_id,array $module){
        foreach ($module as $value) {
            $sql = "INSERT INTO QuestionModules (question_id,module_id) VALUES (:question_id, :module_id)";
            $this->db->query($sql);
            $this->db->bind(':question_id', $question_id);
            $this->db->bind(':module_id', $value);
            $this->db->execute();
        }
    }

    public function deleteQuestionModule(int $question_id){
        $sql = "DELETE FROM QuestionModules WHERE question_id = :question_id";
        $this->db->query($sql);
        $this->db->bind(':question_id', $question_id);
        $this->db->execute();
    }

    public function updateQuestionModule(int $question_id,array $module){
        $sql = "DELETE FROM QuestionModules WHERE question_id = :question_id";
        $this->db->query($sql);
        $this->db->bind(':question_id', $question_id);
        $this->db->execute();
        $this->createQuestionModule($question_id,$module);
    }
}
