function agregarUsuario() {
    console.log("Ejecutando agregarUsuario()...");

    var password1 = document.getElementById('password1').value;
    var password2 = document.getElementById('password2').value;

    // Validación de la contraseña
    if (password1.length < 8) { 
        alert('La contraseña debe tener al menos 8 caracteres.');
        return;
    }
    if (!/[A-Z]/.test(password1)) { 
        alert('La contraseña debe contener al menos una letra mayúscula.');
        return;
    }
    if (!/[0-9]/.test(password1)) { 
        alert('La contraseña debe contener al menos un número.');
        return;
    }
    if (password1 !== password2) { 
        alert('Las contraseñas no coinciden.');
        return;
    }

    // Creación del objeto de datos
    var datos = new URLSearchParams();
    datos.append("nombre", document.getElementById('nombre').value);
    datos.append("apellidoPat", document.getElementById('apellidoPat').value);
    datos.append("apellidoMat", document.getElementById('apellidoMat').value);
    datos.append("dni", document.getElementById('dni').value);
    datos.append("fechaNac", document.getElementById('fechaNac').value);
    datos.append("empresa", document.getElementById('empresa').value);
    datos.append("cargo", document.getElementById('cargo').value);
    datos.append("sector", document.getElementById('sector').value);
    datos.append("pais", document.getElementById('pais').value);
    datos.append("email", document.getElementById('email').value);
    datos.append("password1", password1);
    datos.append("level2", document.getElementById('level2').value);

    // Envío de datos con Fetch API
    fetch('./PHP/agregar_usuario.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: datos.toString()
    })
    .then(response => response.text())
    .then(responseText => {
        console.log("Respuesta del servidor:", responseText);
        if (responseText.includes("Registro exitoso")) {
            console.log("Redireccionando...");
            window.location.href = 'index.php?p=tumail&nombre=' + encodeURIComponent(document.getElementById('nombre').value) + 
                '&apellidoPat=' + encodeURIComponent(document.getElementById('apellidoPat').value) + 
                '&email=' + encodeURIComponent(document.getElementById('email').value);
        } else {
            console.log("Error en el registro:", responseText);
            alert("Error al registrar: " + responseText);
        }
    })
    .catch(error => {
        console.error("Error en la petición:", error);
        alert("Ocurrió un error al procesar la solicitud.");
    });
}

function iniciarSesion() {
    var email = document.getElementById('email').value;
    var password = document.getElementById('password').value;
    
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
                    //window.location.href = 'http://localhost/integridadQHSE/index.php';
                    window.history.pushState({}, '', 'index.php?p=/main');
                }
            }
        };
        xhr.send('email=' + encodeURIComponent(email) + '&password=' + encodeURIComponent(password));
    } else {
        alert('Por favor, complete todos los campos.');
    }
}



function guardarCambios() {
    // Obtener los valores del formulario
    var id = document.getElementById("id").value;
    var nombre = document.getElementById("nombre").value;
    var apellidoPat = document.getElementById("apellidoPat").value;
    var apellidoMat = document.getElementById("apellidoMat").value;
    var dni = document.getElementById("dni").value;
    var fechaNac = document.getElementById("fechaNac").value;
    var empresa = document.getElementById("empresa").value;
    var cargo = document.getElementById("cargo").value;
    var sector = document.getElementById("sector").value;
    var pais = document.getElementById("pais").value;
    var email = document.getElementById("email").value;
    //var password1 = document.getElementById("password1").value;
    //var password2 = document.getElementById("password2").value;
    var level2 = document.getElementById("level2").value;

    // Crear un objeto con los datos del usuario
    var userData = {
        id: id,
        nombre: nombre,
        apellidoPat: apellidoPat,
        apellidoMat: apellidoMat,
        dni: dni,
        fechaNac: fechaNac,
        empresa: empresa,
        cargo: cargo,
        sector: sector,
        pais: pais,
        email: email,
        level2: level2
    };


    var xhr = new XMLHttpRequest();
    xhr.open("POST", "./PHP/actualizar_usuario.php", true);
    xhr.setRequestHeader("Content-Type", "application/json");
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            
            console.log(xhr.responseText);
            alert("Los cambios se guardaron correctamente.");
            
            window.history.pushState({}, '', 'index.php?p=/view_usuarios');
        }
    };
    xhr.send(JSON.stringify(userData));
}



