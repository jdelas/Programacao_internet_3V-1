<?php 

require_once __DIR__ . '/../model/tarefa.php';

class tarefaController{
    private Tarefa $tarefaModel; 

    public function __construct(){
        $this->tarefaModel = new Tarefa(); 
    }

    public function index(){
        $tarefas = $this->tarefaModel->listar(); 
        include __DIR__ . '/../view/listar.php'; 
    }

    #Adicionar

    public function criar(){
        if(isset($_POST['descricao']) && !empty(trim($_POST['descricao']))){
            $this->tarefaModel->criar($_POST['descricao']);
        }
        header("Location: index.php");
    }

    #Excluir

    public function excluir(){
        if(isset($_GET['id'])){
            $this->tarefaModel->excluir($_GET['id']);
        }
        header("Location: index.php"); 
    }

    #Editar

    public function editar(){
        if(isset($_POST['id']) && isset($_POST['descricao']) && !empty(trim($_POST['descricao']))){
            $this->tarefaModel->editar($_POST['descricao'], $_POST['id']);
        }
        header("Location: index.php");
    }
}

?>