<?php
class Conexao {
    private $host = "localhost";
    private $usuario = "root";
    private $senha = "";
    private $dbname = "chat_app_db";
    private $conexao;

    public function __construct() {
        try {
            $this->conexao = new PDO("mysql:host={$this->host};dbname={$this->dbname}", $this->usuario, $this->senha);
            $this->conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
        } catch (PDOException $e) {
            echo "Erro na conexão: " . $e->getMessage();
        }
    }

    public function getConexao() {
        return $this->conexao;
    }
}

// Exemplo de uso:
$conexaoObjeto = new Conexao();
$conn = $conexaoObjeto->getConexao();

// Agora você pode usar a variável $conn para executar consultas no banco de dados
?>
