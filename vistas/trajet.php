<link rel="stylesheet" href="./CSS/styleB.css">
<style>
body {
    background-image: url('./imagenes/fondoWEB.webp');
    background-repeat: repeat;
    background-attachment: fixed;
    margin-top: 50px;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    padding: 20px;
    overflow-y: auto; 
}

.containerForm form {
    display: flex;
    flex-direction: column;
    width: 90%;
    max-width: 700px; /* Evita que se extienda demasiado en pantallas grandes */
    margin: 0 auto; /* Centra horizontalmente */
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
}

h1 {
    text-align: center;
    margin-bottom: 20px;
}

h2 {
    text-align: center;
    margin-bottom: 10px;
    color: #f71313;
}
</style>
<?php
// No espacios arriba

if (!isset($_SESSION)) {
    session_start();
}

$usuario = isset($_SESSION['usuario_id']) ? $_SESSION['usuario_id'] : "desconocido";
?>
<body>
    <div class="containerForm">
        <form>
            <h1>Trouver mon trajet</h1>
            <div>
                <input type="hidden" id="usuario_id" name="usuario_id" value="<?php echo $usuario; ?>">
                <?php echo "<h2>utilisateur inconnu</h2>"; ?>
                <label for="origen">Origine :</label>
                <input type="text" id="origen" name="origen" placeholder="Entrez l'origine.." autocomplete="off" required>
                <ul id="listaOrigen"></ul>
                <label for="destino">Destination :</label>
                <input type="text" id="destino" name="destino" placeholder="Entrez la destination.." autocomplete="off" required>
                <ul id="listaDestino"></ul>
                <label for="fecha">Date de départ :</label>
                <input type="date" id="fecha" name="fecha" placeholder="Entrez la date de départ.." autocomplete="off" required>
                <button type="button" onclick="buscarDestinos(event)">Rechercher</button>
                <div>
                    <ul id="listaDestinos"></ul>
                </div>
            </div>
        </form>
    </div>


<script>
function obtenerUbicacion(event) {
    event.preventDefault(); // Evita que el formulario recargue la página

    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(mostrarPosicion, mostrarError);
    } else {
        alert("La geolocalización no es compatible con este navegador.");
    }
}

function mostrarPosicion(position) {
    const lat = position.coords.latitude;
    const lon = position.coords.longitude;
    alert("Latitud: " + lat + "\nLongitud: " + lon);
}

function mostrarError(error) {
    switch(error.code) {
        case error.PERMISSION_DENIED:
            alert("Permiso denegado para obtener ubicación.");
            break;
        case error.POSITION_UNAVAILABLE:
            alert("Ubicación no disponible.");
            break;
        case error.TIMEOUT:
            alert("Tiempo de espera agotado.");
            break;
        default:
            alert("Error desconocido.");
            break;
    }
}
///--------------------code to find the origin------------------///
document.getElementById("origen").addEventListener("keyup", getCodigos2);

function getCodigos2() {
    let inputCP = document.getElementById("origen").value.trim();
    let lista = document.getElementById("listaOrigen");

    if (inputCP === "") {
        lista.style.display = "none";
        lista.innerHTML = "";
        return;
    }

    let url = "./PHP/obtener_destino.php";
    let formData = new FormData();
    formData.append("origen", inputCP);

    fetch(url, {
        method: "POST",
        body: formData
    })
    .then((response) => response.json())
    .then((data) => {
        lista.innerHTML = "";
        if (data.length > 0) {
            lista.style.display = "block";
            data.forEach((item) => {
                let li = document.createElement("li");
                li.textContent = item.localidad;
                li.style.padding = "5px";
                li.style.cursor = "pointer";
                li.addEventListener("click", () => {
                    document.getElementById("origen").value = item.localidad;
                    lista.innerHTML = "";
                    lista.style.display = "none";
                });
                lista.appendChild(li);
            });
        } else {
            lista.innerHTML = "<li style='padding:5px;'>No se encontraron resultados</li>";
            lista.style.display = "block";
        }
    })
    .catch((err) => console.error("Error:", err));
}


///--------------------code to find the final destination------------------///
   document.getElementById("destino").addEventListener("keyup", getCodigos);

function getCodigos() {
    let inputCP = document.getElementById("destino").value.trim();
    let lista = document.getElementById("listaDestino");

    if (inputCP === "") {
        lista.style.display = "none";
        lista.innerHTML = "";
        return;
    }

    let url = "./PHP/obtener_destino.php";
    let formData = new FormData();
    formData.append("destino", inputCP);

    fetch(url, {
        method: "POST",
        body: formData
    })
    .then((response) => response.json())
    .then((data) => {
        lista.innerHTML = "";
        if (data.length > 0) {
            lista.style.display = "block";
            data.forEach((item) => {
                let li = document.createElement("li");
                li.textContent = item.localidad;
                li.style.padding = "5px";
                li.style.cursor = "pointer";
                li.addEventListener("click", () => {
                    document.getElementById("destino").value = item.localidad;
                    lista.innerHTML = "";
                    lista.style.display = "none";
                });
                lista.appendChild(li);
            });
        } else {
            lista.innerHTML = "<li style='padding:5px;'>No se encontraron resultados</li>";
            lista.style.display = "block";
        }
    })
    .catch((err) => console.error("Error:", err));
}
///--------------------code to find the final destination------------------///
   function buscarDestinos(event) {
        if (event) event.preventDefault();

        const origen = document.getElementById('origen').value;
        const destino = document.getElementById('destino').value;
        const fecha = document.getElementById('fecha').value;

        fetch('./PHP/buscar_destinos.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: `origen=${encodeURIComponent(origen)}&destino=${encodeURIComponent(destino)}&fecha=${encodeURIComponent(fecha)}`
        })
        .then(response => response.json())
        .then(data => {
            console.log('Data recibida:', data);
            const lista = document.getElementById('listaDestinos'); // <-- Aquí usa listaDestinos
            lista.innerHTML = '';
            lista.style.display = 'block';

            if (!Array.isArray(data)) {
                lista.innerHTML = '<li>Error: respuesta inesperada del servidor</li>';
                return;
            }

            if (data.length === 0) {
                lista.innerHTML = '<li>No se encontraron coincidencias</li>';
                return;
            }

            data.forEach(dest => {
                const li = document.createElement('li');
                li.textContent = `${dest.origen} → ${dest.destino} | ${dest.fecha_salida} a las ${dest.hora_salida}`;
                li.dataset.id = dest.id; // Guardamos el id
                li.addEventListener('click', () => {
                    //window.location.href = `index.php?p=/take_trajet.php&id=${dest.id}`;
                    window.location.href = `index.php?p=/take_trajet&id=${dest.id}`;
                });
                lista.appendChild(li);
            });
        })
        .catch(error => {
            console.error('Error al buscar destinos:', error);
            const lista = document.getElementById('listaDestinos');
            lista.innerHTML = '<li>Error al buscar destinos</li>';
        });
    }
</script>

    
</body>