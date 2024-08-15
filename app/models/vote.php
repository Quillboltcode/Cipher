<?php
namespace Models;
use Core\Model;

class Vote extends Model
{
    public function __construct() {
        parent::__construct();
    }

    public function getVoteCount(int $questionId) {
        $query = 'SELECT COUNT(*) AS vote_count FROM Votes WHERE question_id = :questionId';
        $params = [':questionId' => $questionId];
        return $this->getSingle($query, $params);
    }

    
}