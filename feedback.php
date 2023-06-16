<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Contato</title>
  <link rel="stylesheet" href="css/stylsfeeds.css" />
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

  <main class="container">
    <h2>Contato</h2>
    <form action="https://api.staticforms.xyz/submit" method="post">
      <div class="input-field">
        <input type="text" id="nameInput" name="name" placeholder="Nome" autocomplete="off" required>
        <div class="underline"></div>
      </div>
      <div class="input-field">
        <input type="email" id="emailInput" name="email" placeholder="Email" autocomplete="off" required>
        <div class="underline"></div>
      </div>
      <div class="input-field">
        <textarea id="messageInput" name="message" cols="30" rows="10" placeholder="Mensagem" required></textarea>
        <div class="underline"></div>
      </div>
      <button type="submit">Enviar</button>

      <input type="hidden" name="accessKey" value="e6be5f33-97d9-4d74-8a8c-6f51b0655361"
">
      <input type="hidden" name="redirectTo" value="http://localhost/SiteSaudee-Tcc/menup.php">
    </form>
  </main>

  <script>
    // Define a ContactForm class
    class ContactForm {
      constructor() {
        this.form = document.getElementById('contactForm');
        this.nameInput = document.getElementById('nameInput');
        this.emailInput = document.getElementById('emailInput');
        this.messageInput = document.getElementById('messageInput');

        // Attach an event listener to the form submission
        this.form.addEventListener('submit', this.handleSubmit.bind(this));
      }

      handleSubmit(event) {
        event.preventDefault();
        
        if (!this.validateEmail()) {
          // Display an error message or take appropriate action
          alert('Por favor, insira um endereço de e-mail válido.');
          return;
        }

        // Proceed with form submission
        this.form.submit();
        this.showSuccessMessage();
      }

      validateEmail() {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(this.emailInput.value);
      }

      showSuccessMessage() {
        alert('E-mail enviado com sucesso!');
      }
    }

    // Create an instance of the ContactForm class
    const contactForm = new ContactForm();
  </script>
</body>
</html>
