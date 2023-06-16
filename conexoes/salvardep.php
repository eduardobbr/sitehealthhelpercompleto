<?php

session_start();

class Sistema {
    private $conexao;

    public function __construct() {
        $this->verificarSessao();
        $this->iniciarConexao();
    }

    private function verificarSessao() {
        if (!isset($_SESSION['NomeUsuario']) || empty($_SESSION['NomeUsuario'])) {
            header("Location: index.php");
            exit();
        }

        if (isset($_GET['logout'])) {
            $this->encerrarSessao();
        }
    }

    private function encerrarSessao() {
        session_unset();
        session_destroy();
        header("Location: index.php");
        exit();
    }

    private function iniciarConexao() {
        $this->conexao = new PDO("mysql:host=localhost;dbname=chat_app_db", "root", "");
    }

    public function adicionarComentario() {
        $comentario = $_POST['comentario'];

        // Obtém o ID do usuário do banco de dados
        $usuario_id = $this->obterUsuarioId();

        // Verifica se o usuário está enviando um comentário para si mesmo
        if ($usuario_id === $_SESSION['NomeUsuario']) {
            // Você pode exibir uma mensagem de erro ou redirecionar para uma página adequada
            header("Location: logout.php");
            exit();
        }

        $msg_card = "INSERT INTO comentarios (usuario_id, comentario, last_seen)
                     VALUES (:usuario_id, :comentario, NOW())";

        $stmt = $this->conexao->prepare($msg_card);
        $stmt->bindParam(':usuario_id', $usuario_id);
        $stmt->bindParam(':comentario', $comentario);
        $stmt->execute();

        $this->redirecionarMenup();
    }

    private function obterUsuarioId() {
        $stmt = $this->conexao->prepare("SELECT usuario_id FROM cadastro WHERE NomeUsuario = :nomeUsuario");
        $stmt->bindValue(':nomeUsuario', $_SESSION['NomeUsuario'] ?? null);
        $stmt->execute();
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        return $usuario['usuario_id'];
    }

    private function redirecionarMenup() {
        header("Location: ../menup.php");
        exit;
    }
}

$sistema = new Sistema();
$sistema->adicionarComentario();

?>
