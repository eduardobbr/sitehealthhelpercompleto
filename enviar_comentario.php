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
?>

<!DOCTYPE html>
<html lang="pt_br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enviar mensagem</title>
    <link rel="stylesheet" href="css/stylemss.css">
</head>
<body>
    <nav>
        <a class="logo" href="menup.php">Health Helper</a>
        <div class="mobile-menu">
          <div class="line1"></div>
          <div class="line2"></div>
          <div class="line3"></div>
        </div>
        <ul class="nav-list">
            <li><a href="menup.php">Voltar</a></li>
        </ul>
       </nav>
       <script src="mobile-navbar.js"></script>

<div class="principal">
    <main class="container">
        <h2>mensagem</h2>  
        <form action="conexoes/salvardep.php" method="POST">
            <div class="msg-input-box ">
                <label for="menssage">Escreva sua mensagem abaixo!</label>
                <textarea class="input" id="Text" name="comentario" rows="4" cols="50" placeholder="comentario" required>
        
                </textarea>
                <div class="underline"></div>
                <input type="submit" value="Enviar">   
            </div>
        </form>    
    </main>  
</div>   
</body>
</html>