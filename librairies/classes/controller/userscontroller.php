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
    public function updateUser(){
        $args = array(
            'pseudo' => FILTER_SANITIZE_SPECIAL_CHARS,
            'email' => FILTER_VALIDATE_EMAIL,
            'firstname' => FILTER_SANITIZE_SPECIAL_CHARS,
            'lastname' => FILTER_SANITIZE_SPECIAL_CHARS
        );
        $data = filter_input_array(INPUT_POST,$args);
        $idUser["idUser"] = filter_input(INPUT_POST,"idUser",FILTER_VALIDATE_INT);
        if(!empty($_FILES["file"]["name"])){
            $data["profilPhoto"] = $_FILES["file"]["name"];
        }
        if(!empty($_POST["pwd"])){
          $data["pwd"] = password_hash(filter_input(INPUT_POST,"pwd",FILTER_DEFAULT), PASSWORD_DEFAULT);
        }
        $this->uploadFileImg();
        $this->model->update($data,$idUser);
        $response = ($this->model->getAll("WHERE idUser=".$idUser["idUser"]))[0];
        $response["isConnected"] = true;
        echo json_encode($response);
    }

}