<?php
session_start();

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

require_once "conexao.php";
$conexao = new PDO("mysql:host=localhost;dbname=chat_app_db", "root", "");

class ComentarioManager
{
    private $conexao;

    public function __construct($conexao)
    {
        $this->conexao = $conexao;
    }

    public function getComentarios($usuario_id)
    {
        $stmt = $this->conexao->prepare("SELECT * FROM comentarios WHERE usuario_id != :usuario_id");
        $stmt->bindParam(':usuario_id', $usuario_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}

$comentarioManager = new ComentarioManager($conexao);

$usuario_id = null;
if (isset($_SESSION['NomeUsuario'])) {
    $stmt = $conexao->prepare("SELECT usuario_id FROM cadastro WHERE NomeUsuario = :nomeUsuario");
    $stmt->bindParam(':nomeUsuario', $_SESSION['NomeUsuario']);
    $stmt->execute();
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
    $usuario_id = $usuario['usuario_id'];
}

if (!is_null($usuario_id)) {
    $comentarios = $comentarioManager->getComentarios($usuario_id);
} else {
    $comentarios = [];
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minhas Histórias</title>
    <link rel="stylesheet" href="css/stylehistsss.css">
</head>

<body>
    <nav>
        <a class="logo" href="index.php">Health Helper</a>
        <div class="mobile-menu">
            <div class="line2"></div>
        </div>
        <ul class="nav-list">
            <li><a href="mensagens.php">Voltar</a></li>
        </ul>
    </nav>

    <div class="container container-listagem">
        <ul>
            <?php
            foreach ($comentarios as $comentario) {
                echo "
                <li>
                    <div class='dados'>
                        <form method='POST' action=''>
                            <input type='hidden' name='comentario_id' value='$comentario->comentario_id'>
                            <textarea name='comentario'>$comentario->comentario</textarea>
                            <div class='icone-lista'>
                                <a href='excluir.php?comentario_id=$comentario->comentario_id' onclick=\"return confirm('Tem certeza que deseja excluir este comentário?');\">
                                    <img src='img/excluir.png' alt='Excluir'>
                                </a>
                            </div>
                        </form>
                    </div>
                </li>";
            }
            ?>
        </ul>
    </div>
</body>

</html>
