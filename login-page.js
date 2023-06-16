// login-page.js

class LoginPage {
    constructor() {
        this.form = document.getElementById('login-form');
        this.NomeUsuarioField = document.getElementById('NomeUsuario');
        this.SenhaField = document.getElementById('Senha');
        
        this.form.addEventListener('submit', this.onSubmit.bind(this));
    }
    
    onSubmit(event) {
        event.preventDefault();
        
        const NomeUsuario = this.NomeUsuarioField.value;
        const Senha = this.SenhaField.value;
        
        // Send the form data to the server for validation
        // using AJAX or some other method
        
        // After successful login, redirect the user to another page
    }
}

const loginPage = new LoginPage();
