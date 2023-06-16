<?php
session_start();

require_once '../conexao.php';

class Autenticacao
{
    private $conexao;
    private $nomeUsuarioEmail;
    private $senha;

    public function __construct($conexao)
    {
        $this->conexao = $conexao;
    }

    public function setNomeUsuarioEmail($nomeUsuarioEmail)
    {
        $this->nomeUsuarioEmail = $nomeUsuarioEmail;
    }

    public function setSenha($senha)
    {
        $this->senha = $senha;
    }

    public function autenticar()
    {
        $sql = "SELECT * FROM cadastro WHERE (NomeUsuario = :nomeUsuarioEmail OR Email = :nomeUsuarioEmail)";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindParam(':nomeUsuarioEmail', $this->nomeUsuarioEmail);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_OBJ);
        if ($row) {
            if (password_verify($this->senha, $row->Senha)) {
                $_SESSION['NomeUsuario'] = $row->NomeUsuario;
                return true;
            } else {
                echo "Senha incorreta.";
            }
        } else {
            echo "Usuário não encontrado.";
        }

        return false;
    }
}

$nomeUsuarioEmail = $_POST['NomeUsuarioEmail'];
$senha = $_POST['Senha'];

try {
    $conexao = new PDO("mysql:host=localhost;dbname=chat_app_db;charset=utf8mb4", "root", "");
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro na conexão com o banco de dados: " . $e->getMessage());
}

$autenticacao = new Autenticacao($conexao);
$autenticacao->setNomeUsuarioEmail($nomeUsuarioEmail);
$autenticacao->setSenha($senha);

if ($autenticacao->autenticar()) {
    header("Location: ../menup.php");
    exit;
} else {
    echo "<script>alert('Usuário e/ou senha incorreto(s)');</script>";
    echo "<script>console.log('Nome de usuário/email: $nomeUsuarioEmail | Senha: $senha');</script>";
    echo "<script>location.href='../page.php';</script>";
    exit;
}
?>
