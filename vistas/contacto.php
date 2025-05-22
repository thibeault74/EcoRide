<?php  
    $num1 = rand(1, 10);
    $num2 = rand(1, 10);
?>
<head>
    <link rel="stylesheet" href="./CSS/styleB.css">
</head>
<style>
    .containerForm {
        margin-top: 80px;
    }
</style>
<body>
    <div class="containerForm">
        <form method="post">
            <h1>Envoyez-nous un message</h1>
            <label for="nombre">Nom :</label>
            <input type="text" id="nombre" name="nombre" autocomplete="off" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" autocomplete="off" required>

            <label for="mensaje">Message:</label>
            <textarea id="mensaje" name="mensaje" required></textarea>
            <div id="verif">
                <h2>Résoudre le problème mathématique</h2>
                <p id="sumText" data-translate="sum_question">Quelle est la somme de <strong><?php echo $num1; ?></strong> + <strong><?php echo $num2; ?></strong>?</p>

                <input type="number" id="respuesta" placeholder="Tu respuesta">
                <button onclick="verificarRespuesta(event)" data-translate="verif">Vérifier</button>
            </div>
                    <p id="resultado"></p>
            <div id="bot" style="display: none">
                <button type="submit" id="btnEnviar" onclick="send()" disabled>Envoyer</button>
            </div>
            
        </form>
    </div>
</body>



<script>
    //------------------------------------test del numero-------------------

    const num1 = <?php echo $num1; ?>;
    const num2 = <?php echo $num2; ?>;
    const sumaCorrecta = num1 + num2;

    function verificarRespuesta(event) {
        event.preventDefault();
        const respuestaUsuario = parseInt(document.getElementById('respuesta').value);
        const resultado = document.getElementById('resultado');

        if (respuestaUsuario === sumaCorrecta) {
            resultado.textContent = "Bonne réponse " + sumaCorrecta;
            document.getElementById("bot").style.display = "block";
            document.getElementById("verif").style.display = "none";
            document.getElementById("btnEnviar").disabled = false;
        } else {
            resultado.textContent = "Mauvaise réponse, réessayez";
            document.getElementById("btnEnviar").disabled = true;
        }
    }
    

    function send() {
    var nombre = document.getElementById('nombre').value;
    var email = document.getElementById('email').value;
    var mensaje = document.getElementById('mensaje').value;

    if (nombre.trim() !== '') {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', './PHP/agregar_mensaje.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

        xhr.onload = function () {
            if (xhr.status == 200) {
                var response = xhr.responseText;
                if (response.includes('Registro exitoso')) {
                    alert('Registro exitoso');

                    // Limpiar los campos
                    document.getElementById('nombre').value = '';
                    document.getElementById('email').value = '';
                    document.getElementById('mensaje').value = '';
                } else {
                    alert('Error al registrar: ' + response);
                }
            }
        };
        xhr.send('nombre=' + encodeURIComponent(nombre) + '&email=' + encodeURIComponent(email) + '&mensaje=' + encodeURIComponent(mensaje));
    } else {
        alert('Ingrese un nombre válido.');
    }
}

</script>
