<!DOCTYPE html>
<html lang="pt_br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="css/stylecada.css">
</head>
<body>
    <nav>
        <a class="logo" href="index.php">Health Helper</a>
        <div class="mobile-menu">
          <div class="line1"></div>
          <div class="line2"></div>
          <div class="line3"></div>
        </div>
        </nav>  
    <div class="principal">
    <div class="container">
        <div class="title">Cadastro</div>
        <form action="conexoes/cadastro.php" method="POST">
            <div class="user-details">
            <div class="input-box">
            <label class="details">Nome completo</label>
            <input type="text" placeholder="Nome completo" name="NomeCompleto" required>
            </div>
            <div class="input-box">
            <label class="details">Nome de usuario</label>
            <input type="text" placeholder="nome de usuario" name='NomeUsuario'required>
            </div>
            <div class="mb-3">
		    <label class="input-box">
			Escolher Foto De perfil</label>
		    <input type="file" 
		           class="details"
		           name="pp">
		  </div>

            <div class="input-box">
            <label class="details">Email</label>
            <input type="text" placeholder="Email" name="Email" required>
            </div>
            
            <div class="input-box">
            <label class="details">Numero de telefone</label>
            <input type="text" placeholder="Numero de telefone" name="NumeroTelefone" required>
            </div>
            <div class="input-box">
            <label class="details">Senha</label>
            <input type="password" placeholder="Senha" name="Senha" required>
            </div>
            <div class="input-box">
            <label class="details">Confirmar senha</label>
            <input type="password" placeholder="Confirmar senha" name="ConfirmarSenha" required>
            <div>
            <input type="submit" value="Continue">
            <a href="index.php">Voltar Para Tela Principal</a>
            </div>
        </form>
    </div>
    </div>
    <script src="mobile-navbar.js"></script>
</body>
</html>

