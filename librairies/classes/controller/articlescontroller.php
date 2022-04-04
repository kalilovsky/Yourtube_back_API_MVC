<?php

namespace Controller;

class ArticlesController extends Controller
{
    protected $modelName = "ArticleModel";

    public function index()
    {
        return ("Api introuvable, veuillez réessayer svp.");
    }

    public function getAllCategories()
    {
        echo (json_encode($this->model->getAll("", "categories")));
    }

    public function addArticle()
    {
        $args = array(
            'idUser' => FILTER_VALIDATE_INT,
            'idCategory' => FILTER_VALIDATE_INT,
            'title' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            'smallDesc' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            'tag' => FILTER_SANITIZE_FULL_SPECIAL_CHARS
        );
        $acceptedFile = $this->uploadFile();
        if ($acceptedFile){
            $data = filter_input_array(INPUT_POST,$args);
            $data["fileType"] = $acceptedFile;
            $data["filePath"] = $_FILES["file"]["name"];
            $this->model->insert($data);
            echo (json_encode("Article inséré correctement"));
        }else{
            echo (json_encode("Probleme avec le fichier."));
        }
    }

    public function getAllArticles(){
        echo(json_encode($this->model->getAll("INNER JOIN users ON users.idUser = articles.idUser INNER JOIN categories ON articles.idCategory = categories.idCategorie")));
    }

    public function updateView(){
        $idArticle = filter_input(INPUT_POST,"idArticle",FILTER_VALIDATE_INT);
        $allData = $this->model->getAll("WHERE idArticle = {$idArticle}");
        $data["viewCount"] = $allData[0]["viewCount"] + 1;
        echo json_encode($this->model->update($data,$idArticle));
    }
}
