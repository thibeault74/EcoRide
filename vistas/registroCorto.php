<?php 
require_once './inc/conexion.php'; 
//include './inc/link.php'; 
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
<link rel="stylesheet" href="./CSS/styleB.css">
<body>
    <div class="containerForm">
        <h1>Inscription</h1>

        <form id="userForm">
            <label for="nombre">Nom:</label>
            <input type="text" id="nombre" name="nombre" required><br>

            <label for="apellidoPat">Prenom:</label>
            <input type="text" id="apellidoPat" name="apellidoPat"><br>

            <label for="fechaNac">Date de naissance:</label>
            <input type="date" id="fechaNac" name="fechaNac">

            <label for="telephone">Telephone:</label>
            <input type="text" id="telephone" name="telephone">

            <label for="cargo">Adresse:</label>
            <input type="text" id="adresse" name="adresse"><br>

            <label for="sector">Photo:</label>
            <input type="file" id="photo" name="photo" accept="image/*"><br>


            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" autocomplete="off"><br>

            <p>Le mot de passe doit contenir au moins 8 caractères, incluant une majuscule et un chiffre.</p><br>

            <label for="password1">Mot de passe</label>
            <input type="password" id="password1" name="password1"><i class="bi bi-eye-slash" id="togglePassword1" style="cursor: pointer;"></i><br>

            <label for="password2">Vérification du mot de passe:</label>
            <input type="password" id="password2" name="password2"><i class="bi bi-eye-slash" id="togglePassword2" style="cursor: pointer;"></i>

            <input type="hidden" id="level2" name="level2"value="1">

            <button type="button" onclick="agregarUsuario()">M'inscrire en tant qu'utilisateur</button>
            
        </form>
    </div>


</body>
<script>
function agregarUsuario() {
    console.log("Ejecutando agregarUsuario()...");

    var password1 = document.getElementById('password1').value;
    var password2 = document.getElementById('password2').value;

    // Validaciones como antes
    if (password1.length < 8 || !/[A-Z]/.test(password1) || !/[0-9]/.test(password1) || password1 !== password2) {
        alert('Mot de passe invalide ou non correspondant.');
        return;
    }

    // Preparamos el formulario con FormData (permite archivos)
    var form = document.getElementById("userForm");
    var formData = new FormData(form);
    formData.append("password1", password1); // Ya viene incluido, pero por si acaso

    fetch('./PHP/agregar_usuario.php', {
        method: 'POST',
        body: formData // sin Content-Type manual
    })
    .then(response => response.text())
    .then(responseText => {
        console.log("Respuesta del servidor:", responseText);
        if (responseText.includes("Inscription réussie.")) {
            window.location.href = 'index.php?p=tumail&nombre=' + encodeURIComponent(formData.get("nombre")) + 
                '&apellidoPat=' + encodeURIComponent(formData.get("apellidoPat")) + 
                '&email=' + encodeURIComponent(formData.get("email"));
        } else {
            alert("Erreur lors de l'inscription : " + responseText);
        }
    })
    .catch(error => {
        console.error("Error en la petición:", error);
        alert("Une erreur s'est produite lors du traitement de la demande.");
    });
}

// -----------------------password toggle-----------------------
    const togglePassword1 = document.querySelector('#togglePassword1');
    const passwordField1 = document.querySelector('#password1');

    const togglePassword2 = document.querySelector('#togglePassword2');
    const passwordField2 = document.querySelector('#password2');

    function toggleVisibility(passwordField, toggleIcon) {
    const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordField.setAttribute('type', type);
    
    // Alterna el ícono entre ojo abierto y cerrado
    toggleIcon.classList.toggle('bi-eye');
    toggleIcon.classList.toggle('bi-eye-slash');
}

togglePassword1.addEventListener('click', function () {
    toggleVisibility(passwordField1, togglePassword1);
});

togglePassword2.addEventListener('click', function () {
    toggleVisibility(passwordField2, togglePassword2);
});

</script>
<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

html, body {
    width: 100%;
    overflow-x: hidden; /* Oculta el desbordamiento horizontal en la página */
}

body {
    margin-top: 50px;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    padding: 20px;
    overflow-y: auto; /* Permite desplazamiento vertical solo cuando sea necesario */
}

.containerForm form {
    display: flex;
    flex-direction: column;
    width: 70%;
    margin-left: 150px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
}

.containerForm label {
    margin-top: 10px;
    font-size: 1.5rem;
    color: #000000;
}

.containerForm input[type="text"],
.containerForm input[type="number"],
.containerForm input[type="email"], 
.containerForm input[type="password"],
.containerForm input[type="date"], 
.containerForm select {
    width: 100%;
    padding: 10px;
    margin-top: 5px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 1.3rem;
    background-color: #f9f9f9;
    position: relative;
    color: #333;
}

.containerForm textarea {
    width: 100%;
    padding: 10px;
    margin-top: 5px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 1.3rem;
    background-color: #f9f9f9;
    position: relative;
    color: #333;
}

.containerForm button {
    margin-left: 170px;
    background-color: #28a745;
    color: white;
    border: none;
    padding: 12px;
    font-size: 1.3rem;
    border-radius: 4px;
    cursor: pointer;
    margin-top: 20px;
    width: 50%; /* Asegura que el botón no se desborde */
}

.containerForm button:hover {
    background-color: #218838;
}

.containerForm p {
    font-size: 1.5rem;
    color: #000000;
    margin: 10px 0;
    text-align: center;
}

.containerForm i {
    color: #0024D3;
    cursor: pointer;
    margin-left: 10px;
    position: relative;
    top: -25px;
    left: 90%;
    transform: translateY(-20%);
}

</style>