<?php

include_once '../models/Question.php';

class QuestionController {

    private $model;
    private $conn;

    public function __construct() {
        $this->model = new Question();
    }

    public function index() {
        $this->model->read();
    }
}