<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/stylepags.css">
</head>

<body>
    <nav>
        <a class="logo" href="menup.php">Health Helper</a>
        <div class="mobile-menu">
          <div class="line1"></div>
          <div class="line2"></div>
          <div class="line3"></div>
        </div>
    </nav>  
    <div class="principal">
        <main class="container">
            <h2>Login</h2>
            <form action="conexoes/login.php" method="POST">

                <div class="input-field">
                    
                    <input type="text" class="input" name="NomeUsuarioEmail" id="username"
                    
                    placeholder="Entre com seu nome de usuário ou Email" required>
                    <div class="underline"></div>
                </div>
                <div class="input-field">
                    <input type="password" class="input" name="Senha" id="password"
                    placeholder="Coloque sua senha" required>
                    <div class="underline"></div>
                </div> 
                <button type="submit" class="btn btn-primary">
                    LOGIN
                </button>
                <p>Ainda não tem uma conta? <a href="telacadastro.php">Clique Aqui</a></p>
                <?php if (isset($mensagemErro)): ?>
                    <p class="erro"><?php echo $mensagemErro; ?></p>
                <?php endif; ?>
            </form>
        </main>
    </div>
    <script src="mobile-navbar.js"></script>
    <script src="login-page.js"></script>
</body>
</html>