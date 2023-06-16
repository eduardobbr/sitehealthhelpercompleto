<?php
session_start();

class Database {
    private $host = 'localhost';
    private $dbname = 'chat_app_db';
    private $usuario = 'root';
    private $senha = '';
    private $conexao;

    public function __construct() {
        try {
            $this->conexao = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->usuario, $this->senha);
            $this->conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $erro) {
            echo "<h1>ERRO DE CONEXÃO COM O BANCO DE DADOS!</h1><br>" . $erro->getMessage();
            exit();
        }
    }

    public function deletarComentario($comentario_id) {
        try {
            $deletar = $this->conexao->prepare("DELETE FROM comentarios WHERE comentario_id = :comentario_id");
            $deletar->bindParam(':comentario_id', $comentario_id);
            $deletar->execute();
        } catch (PDOException $erro) {
            echo "<h1>NÃO FOI POSSÍVEL CONCLUIR!</h1><br>" . $erro->getMessage();
            exit();
        }
    }
}

if (!isset($_SESSION['NomeUsuario']) || empty($_SESSION['NomeUsuario'])) {
    header("Location: index.php");
    exit();
}

if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header("Location: index.php");
    exit();
}

if (isset($_GET['comentario_id'])) {
    $comentario_id = $_GET['comentario_id'];

    $database = new Database();
    $database->deletarComentario($comentario_id);

    header('Location: msg.php');
    exit();
}
?>
