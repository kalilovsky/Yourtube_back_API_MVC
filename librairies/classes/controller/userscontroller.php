<?php
namespace Controller;

class UsersController extends Controller{
    protected $modelName = "UsersModel";

    public function login(){
        echo json_encode($this->model->loginUser($_POST));
    }
    public function register(){
       echo json_encode($this->model->registerUser($_POST));
    }

}