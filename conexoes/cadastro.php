<?php
session_start();

require_once "../conexao.php";

class Cadastro
{
    private $conexao;
    private $nomeCompleto;
    private $nomeUsuario;
    private $email;
    private $numeroTelefone;
    private $senha;
    private $confirmarSenha;

    public function __construct($conexao)
    {
        $this->conexao = $conexao;
    }

    public function setNomeCompleto($nomeCompleto)
    {
        $this->nomeCompleto = $nomeCompleto;
    }

    public function setNomeUsuario($nomeUsuario)
    {
        $this->nomeUsuario = $nomeUsuario;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setNumeroTelefone($numeroTelefone)
    {
        $this->numeroTelefone = $numeroTelefone;
    }

    public function setSenha($senha)
    {
        $this->senha = $senha;
    }

    public function setConfirmarSenha($confirmarSenha)
    {
        $this->confirmarSenha = $confirmarSenha;
    }

    public function cadastrar()
    {
        if ($this->usuarioExiste()) {
            return "Usuário já cadastrado.";
        }

        if ($this->senha !== $this->confirmarSenha) {
            return "As senhas não correspondem.";
        }

        $senhaCodificada = password_hash($this->senha, PASSWORD_DEFAULT);

        $sql = "INSERT INTO cadastro(NomeCompleto, NomeUsuario, Email, NumeroTelefone, Senha) 
                VALUES (:nomeCompleto, :nomeUsuario, :email, :numeroTelefone, :senha)";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindParam(':nomeCompleto', $this->nomeCompleto);
        $stmt->bindParam(':nomeUsuario', $this->nomeUsuario);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':numeroTelefone', $this->numeroTelefone);
        $stmt->bindParam(':senha', $senhaCodificada);

        if ($stmt->execute()) {
            return "Cadastrado com sucesso!";
        } else {
            return "Erro ao cadastrar usuário.";
        }
    }

    private function usuarioExiste()
    {
        $sql = "SELECT COUNT(*) FROM cadastro WHERE NomeUsuario = :nomeUsuario";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindParam(':nomeUsuario', $this->nomeUsuario);
        $stmt->execute();
        $count = $stmt->fetchColumn();

        return $count > 0;
    }
}

$nomeCompleto = $_POST['NomeCompleto'];
$nomeUsuario = $_POST['NomeUsuario'];
$email = $_POST['Email'];
$numeroTelefone = $_POST['NumeroTelefone'];
$senha = $_POST['Senha'];
$confirmarSenha = $_POST['ConfirmarSenha'];

try {
    $conexao = new PDO("mysql:host=localhost;dbname=chat_app_db", "root", "");
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro na conexão com o banco de dados: " . $e->getMessage());
}

$cadastro = new Cadastro($conexao);
$cadastro->setNomeCompleto($nomeCompleto);
$cadastro->setNomeUsuario($nomeUsuario);
$cadastro->setEmail($email);
$cadastro->setNumeroTelefone($numeroTelefone);
$cadastro->setSenha($senha);
$cadastro->setConfirmarSenha($confirmarSenha);

$resultado = $cadastro->cadastrar();

if ($resultado === "Cadastrado com sucesso!") {
    echo "<script>alert('Cadastrado com sucesso!')</script>";
    echo "<script>location.href='../page.php'</script>";
} elseif ($resultado === "Usuário já cadastrado.") {
    echo "<script>alert('Usuário já cadastrado.')</script>";
    echo "<script>location.href='../telacadastro.php';</script>";
} elseif ($resultado === "As senhas não correspondem.") {
    echo "<script>alert('As senhas não correspondem.')</script>";
    echo "<script>location.href='../telacadastro.php';</script>";
} else {
    echo "<script>alert('Erro ao cadastrar usuário')</script>";
    echo "<script>location.href='../telacadastro.php';</script>";
}
?>
