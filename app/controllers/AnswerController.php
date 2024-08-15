<?php

use Core\Controller;

class AnswerController extends Controller {
    private object $answermodel;
    public function __construct() {
        
    }

    public function index() {
        $this->view('answer/index');
    }

    public function create() {
        $this->view('answer/create');
    }
}

