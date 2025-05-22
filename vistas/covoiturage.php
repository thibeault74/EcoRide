<link rel="stylesheet" href="./CSS/styleB.css">
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
    margin-left: 100px;
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
    margin-left: 120px;
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
#listaOrigen,
#listaDestino {
    display: none;
    position: absolute;
    background-color: #fff;
    border: 1px solid #ccc;
    border-radius: 6px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    list-style: none;
    margin: 0;
    padding: 0;
    width: 15%; /* se adapta al input */
    z-index: 10;
    max-height: 200px;
    overflow-y: auto;
    font-family: sans-serif;
}

#listaOrigen li,
#listaDestino li {
    padding: 8px 12px;
    cursor: pointer;
    transition: background-color 0.2s;
}

#listaOrigen li:hover,
#listaDestino li:hover {
    background-color: #f0f0f0;
}
</style>
<body>
    <div class="containerForm">
        <form action="" method="POST" enctype="multipart/form-data">
            <p>Créer un nouveau covoiturage</p>
            <label for="origen">Origine :</label>
            <input type="text" id="origen" name="origen" required>
            <ul id="listaOrigen"></ul>

            <label for="destino">Destination :</label>
            <input type="text" id="destino" name="destino" autocomplete="off" required>
            <ul id="listaDestino"></ul>

            <label for="fecha">Date de départ :</label>
            <input type="date" id="fecha" name="fecha" required>

            <label for="hora">Heure de départ :</label>
            <input type="time" id="hora" name="hora" required>

            <label for="precio">Prix par personne:</label>
            <input type="number" id="precio" name="precio" required>

            <label for="descripcion">Description:</label>
            <textarea id="descripcion" name="descripcion"></textarea>

            <button type="submit">Crear viaje</button>
        </form>
    </div>
</body>
<script>
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


</script>