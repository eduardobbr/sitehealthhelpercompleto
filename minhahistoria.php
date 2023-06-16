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

class DepoimentoManager
{
    private $conexao;

    public function __construct($conexao)
    {
        $this->conexao = $conexao;
    }

    public function getDepoimentos($usuario_id)
    {
        $stmt = $this->conexao->prepare("SELECT * FROM depoimento WHERE usuario_id = :usuario_id");
        $stmt->bindParam(':usuario_id', $usuario_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function excluirDepoimento($depoimento_id)
    {
        $stmt = $this->conexao->prepare("DELETE FROM depoimento WHERE depoimento_id = :depoimento_id");
        $stmt->bindParam(':depoimento_id', $depoimento_id);
        $stmt->execute();
    }

    public function atualizarDepoimento($depoimento_id, $titulo, $historia)
    {
        $stmt = $this->conexao->prepare("UPDATE depoimento SET titulo = :titulo, historia = :historia WHERE depoimento_id = :depoimento_id");
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':historia', $historia);
        $stmt->bindParam(':depoimento_id', $depoimento_id);
        $stmt->execute();
    }
}

$depoimentoManager = new DepoimentoManager($conexao);

$usuario_id = null;
if (isset($_SESSION['NomeUsuario'])) {
    $stmt = $conexao->prepare("SELECT usuario_id FROM cadastro WHERE NomeUsuario = :nomeUsuario");
    $stmt->bindParam(':nomeUsuario', $_SESSION['NomeUsuario']);
    $stmt->execute();
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
    $usuario_id = $usuario['usuario_id'];
}

if (!is_null($usuario_id)) {
    $depoimentos = $depoimentoManager->getDepoimentos($usuario_id);
} else {
    $depoimentos = [];
}

if (isset($_POST['atualizar'])) {
    $depoimento_id = $_POST['depoimento_id'];
    $titulo = $_POST['titulo'];
    $historia = $_POST['historia'];
    $depoimentoManager->atualizarDepoimento($depoimento_id, $titulo, $historia);
}

if (isset($_GET['depoimento_id'])) {
    $depoimento_id = $_GET['depoimento_id'];
    $depoimentoManager->excluirDepoimento($depoimento_id);
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
        <a class="logo" href="menup.php">Health Helper</a>
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
            foreach ($depoimentos as $depoimento) {
                echo "
                <li>
                    <div class='dados'>
                        <form method='POST' action=''>
                            <input type='hidden' name='depoimento_id' value='$depoimento->depoimento_id'>
                            <input type='text' name='titulo' value='$depoimento->titulo'>
                            <textarea name='historia'>$depoimento->historia</textarea>
                            <button type='submit' name='atualizar'>Atualizar</button>
                        </form>
                    </div>

                    <div class='icone-lista'>
                        <a href='?depoimento_id=$depoimento->depoimento_id' onclick=\"return confirm('Tem certeza que deseja excluir esta história?');\">
                            <img src='img/excluir.png' alt='Excluir'>
                        </a>
                    </div>
                </li>";
            }
            ?>
        </ul>
    </div>
    <script>
        <?php
        if(isset($_GET['depoimento_id']) || isset($_POST['atualizar'])){
            echo'window.location.href = window.location.pathname;';
        }
        ?>
    </script>
</body>

</html>
