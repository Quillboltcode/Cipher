<?php 
namespace Models;
use Core\Model;

class Contact extends Model{
    public function __construct() {
        parent::__construct();
    }
    // Save to table Contacts with user_id
    public function saveEmail($data) {
        $this->db->query('INSERT INTO Contacts (user_id, email, subject, message) VALUES (:user_id, :email, :subject, :message)');
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':subject', $data['subject']);
        $this->db->bind(':message', $data['message']);
        if ($this->db->execute()) {
            return true;
        } else {
            //todo return a more detailed error
            return $this->db->getError();
        }
    }
}