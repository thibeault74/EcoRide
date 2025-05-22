<?php require_once './inc/conexion.php'; ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
<body>
    <div class="containerForm">
        <h1>Inscription des utilisateurs</h1>

        <form id="userForm">
            <label for="nombre">Noms :</label>
            <input type="text" id="nombre" name="nombre" required><br>

            <label for="apellidoPat">Nom paternel :</label>
            <input type="text" id="apellidoPat" name="apellidoPat"><br>

            <label for="apellidoMat">Nom maternel :</label>
            <input type="text" id="apellidoMat" name="apellidoMat"><br>

            <label for="dni">D.N.I:</label>
            <input type="text" id="dni" name="dni"><br>

            <label for="fechaNac">Date de naissance :</label>
            <input type="date" id="fechaNac" name="fechaNac"><br>

            <label for="empresa">Entreprise:</label>
            <select id="empresa" name="empresa">
                
                <?php
                $query = "SELECT DISTINCT empresa FROM cargo WHERE empresa = '" . $_SESSION['usuario_empresa'] . "'";
                $result = $conexion->query($query);
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['empresa'] . "'>" . $row['empresa'] . "</option>";
                }
                ?>
            </select><br>

            <label for="cargo">Poste:</label>
            <select id="cargo" name="cargo">
            <option value="0">Sélectionnez un poste</option>
                <?php
                $query = "SELECT DISTINCT cargo FROM cargo WHERE empresa = '" . $_SESSION['usuario_empresa'] . "'";
                $result = $conexion->query($query);
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['cargo'] . "'>" . $row['cargo'] . "</option>";
                }
                ?>
            </select><br>

            <label for="sector">Secteur:</label>
            <select id="sector" name="sector">
            <option value="0">Sélectionnez un secteur</option>
                <?php
                $query = "SELECT DISTINCT sector FROM cargo WHERE empresa = '" . $_SESSION['usuario_empresa'] . "'";
                $result = $conexion->query($query);
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['sector'] . "'>" . $row['sector'] . "</option>";
                }
                ?>
            </select><br>

            <label for="pais">Pays:</label>
            <select id="pais" name="pais">
            <option value="0">Sélectionnez un pays</option>
                <?php
                $query = "SELECT DISTINCT pais FROM cargo WHERE empresa = '" . $_SESSION['usuario_empresa'] . "'";
                $result = $conexion->query($query);
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['pais'] . "'>" . $row['pais'] . "</option>";
                }
                ?>
            </select><br>

            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email"><br>

            <p>Le Mot de passe doit contenir au moins 8 caractères, dont une majuscule et un chiffre.</p><br>

            <label for="password1">Mot de passe:</label>
            <input type="password" id="password1" name="password1">
            <i class="bi bi-eye-slash" id="togglePassword1" style="cursor: pointer;"></i>
            <br>
            <label for="password2">Vérification du mot de passe :</label>
            <input type="password" id="password2" name="password2">
            <i class="bi bi-eye-slash" id="togglePassword2" style="cursor: pointer;"></i>
            <br>
            <label for="level2">Niveau utilisateur</label>
            <select id="level2" name="level2">
                <option value="1">Utilisateur</option>
                <option value="2">Responsable</option>
                <option value="3">Administrateur</option>
            </select><br>

            <button type="button" onclick="agregarUsuario()">Ajouter un utilisateur</button>
        </form>
    </div>


</body>
<script>
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
/*    * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    padding: 20px;
}
*/


.containerForm {
    
    background-color: #4d89b8;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 600px;

    /* Centrado del formulario */
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    margin: 0 auto; /* Centrado horizontal */
    margin-bottom: 20px;
}

.containerForm h1 {
    text-align: center;
    margin-bottom: 20px;
    font-size: 24px;
    color: #FFFFFF;
}

.containerForm form {
    display: flex;
    flex-direction: column;
}

.containerForm label {
    margin-top: 10px;
    font-size: 14px;
    color: #FFFFFF;
}

.containerForm input[type="text"], 
.containerForm input[type="email"], 
.containerForm input[type="password"],
.containerForm input[type="date"], 
.containerForm select {
    width: 100%;
    padding: 10px;
    margin-top: 5px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 14px;
    background-color: #f9f9f9;
}

.containerForm button {
    background-color: #28a745;
    color: white;
    border: none;
    padding: 12px;
    font-size: 16px;
    border-radius: 4px;
    cursor: pointer;
    margin-top: 20px;
}

.containerForm button:hover {
    background-color: #218838;
}

.containerForm p {
    font-size: 12px;
    color: #FFFFFF;
    margin: 10px 0;
}

.containerForm i {
    cursor: pointer;
    margin-left: 10px;
    position: relative;
    top: -30px;
    left: 60%;
    transform: translateX(30%);
}



@media (max-width: 768px) {
    .containerForm {
        padding: 15px;
        max-width: 100%;
    }

    .containerForm input[type="text"], 
    .containerForm input[type="email"], 
    .containerForm input[type="password"], 
    .containerForm input[type="date"], 
    .containerForm select, 
    .containerForm  {
        font-size: 14px;
        padding: 10px;
    }

    .containerForm h1 {
        font-size: 20px;
    }

    .containerForm label {
        font-size: 12px;
    }

    .containerForm i {
        left: 50%;
    }
}


</style>