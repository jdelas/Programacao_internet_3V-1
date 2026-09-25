<?php 

require_once __DIR__ . '/../config/database.php';

class Tarefa{
    private ?mysqli $conn = null; 

    public function __construct(){
        $db = new Database();
        $this->conn = $db->conectar();
    }

    # Listar

    public function listar(): array {
        $tarefas = []; 
        $sql = "SELECT * FROM tarefas ORDER BY data_criacao DESC"; 
        $resultado = $this->conn->query($sql); 

        if($resultado->num_rows > 0){
            while($row = $resultado->fetch_assoc()){
                $tarefas[] = $row; 
            }
        }

        return $tarefas; 
    }

    # Criar

    public function criar(string $descricao): bool {
        $descricao = $this->conn->real_escape_string($descricao);
        $sql = "INSERT INTO tarefas (descricao) VALUES ('$descricao')";
        return $this->conn->query($sql); 
    }

    # Excluir 

    public function excluir(int $id): bool {
        $id = intval($id);
        $sql = "DELETE FROM tarefas WHERE id = $id"; 
        return $this->conn->query($sql); 
    }

    # Editar
    public function editar(string $descricao, int $id): bool {
        $descricao = $this->conn->real_escape_string($descricao);
        $id = intval($id);
        $sql = "UPDATE tarefas SET descricao = '$descricao' WHERE id = '$id'";
        return $this->conn->query($sql); 
    }
}