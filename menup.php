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

include_once 'conexao.php';
$conexao = new PDO("mysql:host=localhost;dbname=chat_app_db", "root", "");

$query = "SELECT depoimento.titulo, depoimento.historia, cadastro.NomeCompleto
          FROM depoimento
          INNER JOIN cadastro ON depoimento.usuario_id = cadastro.usuario_id";

// Verifica se uma consulta de busca foi enviada
if (isset($_GET['search'])) {
  $search = $_GET['search'];
  $query .= " WHERE cadastro.NomeCompleto LIKE :search";
}

$query .= " ORDER BY depoimento.depoimento_id DESC";

$stmt = $conexao->prepare($query);

// Define o valor do parâmetro de busca, se estiver presente
if   (isset($search)) {
  $stmt->bindValue(':search', '%' . $search . '%');
}

$stmt->execute();
$result_card = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <link rel="stylesheet" href="css/Stylemenuups.css">
    <style>
    /* Adicione o código CSS fornecido anteriormente */


  </style>
</head>
<body>
    <nav>
        <a class="logo" href="menup.php">HealthHelper</a>
        <div class="mobile-menu">
            <div class="line1"></div>
            <div class="line2"></div>
            <div class="line3"></div>
        </div>
        <ul class="nav-list">
            <li><a href="mensagens.php">Conte Sua História</a></li>
            <li><a href="feedback.php">Fale conosco</a></li>
            <li><a href="?logout=true">Sair</a></li>
            <li class="user-profile">
            <span class="username"><?php echo $_SESSION['NomeUsuario']; ?></span>
            </li>
        </ul>
    </nav>

    <script src="mobile-navbar.js"></script>

    <div class="container">
    <form method="GET" action="">
      <div class="search-container">
        <div class="search-icon"></div>
        <input type="text" class="search-input" name="search" placeholder="Buscar por nome">
        <button type="submit" class="search-button">Buscar</button>
      </div>
    </form>

    <?php foreach ($result_card as $dado) { ?>
      <div class="card card-1">
        <div class="card-header">
          <h4 class="card-nome"><?php echo $dado["NomeCompleto"]; ?></h4>
        </div>
        <div class="card-body">
          <h3 class="card-local"><?php echo $dado["titulo"]; ?></h3>
          <p class="card-texto"><?php echo $dado["historia"]; ?></p>
        </div>
        <div class="card-footer">
          <a href="enviar_comentario.php" class="card-link">Enviar mensagem</a>
        </div>
      </div>
    <?php } ?>
  </div>

  <script>
    // Código JavaScript para exibir/esconder o campo de busca ao clicar no ícone de busca
    const searchIcon = document.querySelector('.search-icon');
    const searchInput = document.querySelector('.search-input');

    searchIcon.addEventListener('click', () => {
      searchInput.classList.toggle('expand');
    });
  </script>

</body>
</html>
