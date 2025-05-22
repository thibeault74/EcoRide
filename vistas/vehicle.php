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
</style>
<body>
    <div class="containerForm">
        <h1>Formulaire d'immatriculation du véhicule</h1>

        <form id="vehicleForm" enctype="multipart/form-data">
            <input type="text" id="usuario_id" name="usuario_id" value="<?php echo $_SESSION['usuario_id']; ?>" hidden>

            <label for="marca">Quelle est la marque de votre véhicule ?</label>
            <input type="text" id="marca" name="marca" required><br>

            <label for="modele">Quel est le modèle de votre véhicule ?</label>
            <input type="text" id="modele" name="modele"><br>

            <label for="date_immatriculation">Quelle est la date d'immatriculation ?</label>
            <input type="date" id="date_immatriculation" name="date_immatriculation">

            <label for="immatriculation">Quelle est la plaque d'immatriculation ?</label>
            <input type="text" id="immatriculation" name="immatriculation" required><br>

            <label for="energie">Quel est le type d’énergie utilisée par votre véhicule ?</label>
            <select name="energie" id="energie">
                <option value="">Sélection...</option>
                <option value="essence">Essence</option>
                <option value="diesel">Diesel</option>
                <option value="electrique">Électrique</option>
                <option value="hybride">Hybride</option>
                <option value="hydrogène">Hydrogène</option>
                <option value="GPL">GPL</option>
                <option value="GNV">GNV</option>
            </select>

            <label for="places">Combien de places le véhicule a-t-il, sans compter celle du conducteur ?</label>
            <input type="number" id="places" name="places"><br>

            <label for="couleur">Quelle est la couleur de votre véhicule ?</label>
            <input type="text" id="couleur" name="couleur"><br>

            <label for="photo">Photo:</label>
            <input type="file" id="photo" name="photo" accept="image/*"><br>

            <button type="button" onclick="agregarVehiculo()">Inscrire mon véhicule</button>
        </form>
    </div>
</body>

<script>
function agregarVehiculo() {
    console.log("Envoi du formulaire...");

    const form = document.getElementById('vehicleForm');
    const formData = new FormData(form);

    fetch('./PHP/agregar_vehiculo.php', { // Cambia a tu archivo PHP correcto
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(responseText => {
        console.log("Réponse du serveur:", responseText);
        if (responseText.includes("Vehículo registrado correctamente")) {
            alert("Inscription réussie.");
            window.location.href = "index.php?p=/vehicle";
        } else {
            alert("Erreur lors de l'inscription : " + responseText);
        }
    })
    .catch(error => {
        console.error("Erreur de requête:", error);
        alert("Une erreur s'est produite lors du traitement de la demande.");
    });
}
</script>