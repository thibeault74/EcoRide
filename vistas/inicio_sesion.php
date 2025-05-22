
    <?php 
    require_once './inc/conexion.php'; 
    $num1 = rand(1, 10);
    $num2 = rand(1, 10);
    ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./CSS/styleB.css">
    <title>Login</title>
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
           
            font-size: 1.3rem;
            color: #000000;
            line-height: 1.7;

            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            /*background-color: #0024D3;*/
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            max-width: 400px; 
            margin: 10px auto;
            padding: 1rem;
        }

        h1 {
            padding: 5px 0;
            font-size: 1.5rem; 
            color: #000000;
            text-align: center;
        }

        input {
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
            outline: none;
            width: 100%;
            border: solid 1px #ccc;
        }

        button {
            box-sizing: border-box;
            width: 100%;
            padding: 10px; 
            background: #00B48F;
            border: none;
            color: #ffffff;
            font-size: 20px;
            border-radius: 5px;
        }

        button:hover {
            background: #0069d9;
            cursor: pointer;
        }

        .submit {
            margin-top: 10px;
        }
        #mostrar_contrasena {
            padding-left: 10px;
            border: red 2px solid;
        }

        a{
            color: white;
        }
        .container i {
            color: #0024D3;
            cursor: pointer;
            margin-left: 10px;
            position: relative;
            top: -25px;
            left: 90%;
            transform: translateY(-20%);
        }

@media (max-width: 768px) {
    .container {
        padding: 15px;
        max-width: 100%;
    }

    .container input[type="email"], 
    .container input[type="password"], 
    .container select, 
    .container  {
        font-size: 14px;
        padding: 10px;
    }

    .container h1 {
        font-size: 20px;
    }

    .container label {
        font-size: 12px;
    }

    .container i {
        left: 90%;

    }
}


    </style>
</head>
<body>
    <div class="container">
        <h1>Se connecter</h1>

        <form id="loginForm">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Mot de passe</label>
            <input type="password" id="password" name="password" required><i class="bi bi-eye-slash" id="togglePassword" style="cursor: pointer;"></i>
            
            <div id="verif">
                <h3>Résoudre le problème mathématique</h3>
                <p id="sumText" data-translate="sum_question">Quelle est la somme de <strong><?php echo $num1; ?></strong> + <strong><?php echo $num2; ?></strong>?</p>

                <input type="number" id="respuesta" placeholder="Réponse">
                <button onclick="verificarRespuesta(event)" data-translate="verif">Vérifier</button>
            </div>
            <p id="resultado"></p>
            
            <div id="bot" style="display: none">
                <div style="margin-top:15px;">
                        <a href="./politicaRGDP.php">Créer un compte</a><br>
                        <a href="index.php?p=/recuperar_clave">Mot de passe oublié ?</a><br>
                        
                    <button type="button" onclick="iniciarSesion()" id="btnEnviar" disabled>Se connecter à mon compte</button>
                </div>
            </div>
        </form>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    const togglePassword = document.querySelector('#togglePassword');
    const passwordField = document.querySelector('#password');

    function toggleVisibility(passwordField, toggleIcon) {
    const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordField.setAttribute('type', type);
    
    // Alterna el ícono entre ojo abierto y cerrado
    toggleIcon.classList.toggle('bi-eye');
    toggleIcon.classList.toggle('bi-eye-slash');
    }

    togglePassword.addEventListener('click', function () {
        toggleVisibility(passwordField, togglePassword);
    });

    function iniciarSesion() {
    var email = document.getElementById('email').value;
    var password = document.getElementById('password').value;
    console.log ("iniciar sesion activado");
    //var password = validate_password(password);

    if (email.trim() !== '' && password.trim() !== '') {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', './PHP/login.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onload = function () {
            if (xhr.status == 200) {
                var response = xhr.responseText;
                alert(response); // Muestra la respuesta del servidor
                if (response.includes('Inicio de sesión exitoso')) {
                    // Redirigir o realizar otras acciones después del inicio de sesión exitoso
                    window.location.href = 'index.php';
                    //window.history.pushState({}, '', 'index.php?p=/main');
                    //window.history.pushState({}, '', 'index.php');
                }
            }
        };
        xhr.send('email=' + encodeURIComponent(email) + '&password=' + encodeURIComponent(password));
    } else {
        alert('Por favor, complete todos los campos.');
    }
}
//------------------------------------test del numero-------------------

        const num1 = <?php echo $num1; ?>;
        const num2 = <?php echo $num2; ?>;
        const sumaCorrecta = num1 + num2;

        function verificarRespuesta(event) {
            event.preventDefault();
            const respuestaUsuario = parseInt(document.getElementById('respuesta').value);
            const resultado = document.getElementById('resultado');

            if (respuestaUsuario === sumaCorrecta) {
                resultado.textContent = "Correct " + sumaCorrecta;
                document.getElementById("bot").style.display = "block";
                document.getElementById("verif").style.display = "none";
                document.getElementById("btnEnviar").disabled = false;
            } else {
                resultado.textContent = "Faux, réessayez.";
                document.getElementById("btnEnviar").disabled = true;
            }
        }
</script>
</body>
</html>
