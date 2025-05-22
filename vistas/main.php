<!DOCTYPE html>
<html lang="es">
<?php
//include_once './inc/functions.php';
include "./inc/head.php";
//registrarVisita($conexion);
?>
<!--<link rel="stylesheet" href="styleB.css">-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
    body {
    margin: 0;
    padding: 0;
    width: 100%;
    overflow-x: hidden;
    background-image: url('./imagenes/fondoWEB.webp'); 
    background-repeat: repeat; 
    background-size: auto;
    background-attachment: fixed;
}

.responsive {
    width: 100%;
    max-width: 100%;
    height: 100%;
    display: block;
    margin: 0 auto;
}

.responsive-image {
    width: 100%;
    height: auto;
    display: block;
    position: relative;
}
    
    /* Contenedor centrado sobre la imagen */
.overlay-center {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: 2;
    text-align: center;
 }
    
    /* Estilos del buscador */
.buscador-container input,
.buscador-container button {
    padding: 10px;
    font-size: 1rem;
    border-radius: 8px;
    border: none;
    margin: 5px;
}
    
.buscador-container button {
    background-color: #3759FF;
    color: white;
    cursor: pointer;
}

#btn-buscar {
    background-color: rgba(55, 89, 255, 0.7); /* azul semi-transparente */
    color: white;
    padding: 10px 14px;
    border: none;
    border-radius: 50%;
    font-size: 1.2rem;
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.2s ease;
}
    
#btn-buscar:hover {
    background-color: rgba(55, 89, 255, 1); /* más opaco al pasar el mouse */
    transform: scale(1.1); /* ligera ampliación */
}
    
#btn-buscar i {
    pointer-events: none; /* evita que el ícono interrumpa el clic */
}

.container-block {
  background-color: rgba(55, 89, 255, 0.6); /* azul semi-transparente */
  color: white;
  padding: 20px;
  border-radius: 10px;
  margin-left: 110px;
  margin-top: 70px;
  width: 70%;
  display: flex;
  justify-content: space-between;
  align-items: center;
  gap: 20px;
}

.text-content {
  width: 60%;
  text-align: left;
}

.image-content {
  width: 35%;
}

.image-content img {
  max-width: 100%;
  height: auto;
  border-radius: 10px;
}

h1, h2, h3, title {
    font-family: 'Sketchy', sans-serif;
}

p {
    font-family: sans-serif;
}
</style>

<body>
    <div>
        <img src="./imagenes/principal.webp" alt="In the road" class="responsive-image">
        <div class="overlay-center">
            <div class="buscador-container">
                <input type="text" id="buscador" placeholder="Nouveau trajet..." onkeyup="filtrarTarjetas()">
                <button id="btn-buscar" onclick="filtrarTarjetas()">
                <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </div>

    <div class="container-block">
        <div class="text-content">
            <h1>EcoRide</h1>
            <h2>Bienvenue sur EcoRide</h2><br>
            <p>Nous sommes ravis de vous accueillir sur notre plateforme de covoiturage écologique. Ici, vous pouvez trouver des trajets partagés pour réduire votre empreinte carbone et voyager de manière responsable.</p>
            <p>Explorez nos options de covoiturage et rejoignez notre communauté engagée pour un avenir plus durable.</p>
            <p>Pour plus d'informations, n'hésitez pas à nous contacter.</p>   
        </div>
        <div class="image-content">
            <img src="./imagenes/ecoride1.webp" alt="Covoiturage" />
        </div>
    </div>
    
    <div class="container-block">
        <div class="image-content">
            <img src="./imagenes/ecoride2.webp" alt="Covoiturage" />
        </div>
        <div class="text-content">
            <h1>Electric ou combustion</h1>
            <h2>Choisissez le type de carburant et découvrez votre empreinte carbone.</h2>
            <p>Nous vous offrons la possibilité de choisir entre des véhicules électriques et à combustion. En optant pour un véhicule électrique, vous contribuez à réduire les émissions de CO2 et à préserver notre planète.</p>
            <p>Nous vous encourageons à faire le choix qui correspond le mieux à vos valeurs et à votre style de vie.</p>
            <p>Pour plus d'informations, n'hésitez pas à nous contacter.</p>
        </div>
    </div>

    <div class="container-block">
        <div class="text-content">
            <h1>Utilisateur o conducteur</h1>
            <h2>Choisissez votre rôle et commencez à partager des trajets.</h2>
            <p>Que vous soyez un conducteur cherchant à partager vos trajets ou un utilisateur à la recherche d'un moyen de transport, EcoRide est là pour vous aider.</p>
            <p>Inscrivez-vous dès aujourd'hui et rejoignez notre communauté de covoiturage responsable.</p>
        </div>
        <div class="image-content">
            <img src="./imagenes/ecoride-driver.webp" alt="Covoiturage" />
        </div>
    </div>

    <div class="container-block">
        <div class="image-content">
            <img src="./imagenes/ecoride-safety.webp" alt="Covoiturage" />
        </div>
        <div class="text-content">
            <h1>Eco sécurité</h1>
            <h2>Assurez-vous que votre trajet est sûr et sécurisé.</h2>
            <p>Nous prenons la sécurité de nos utilisateurs très au sérieux. Suivi en temps réel de chaque trajet.</p>
            <p>Nous nous engageons à garantir la sécurité de nos utilisateurs. Tous les conducteurs sont vérifiés et évalués par la communauté.</p>
            <p>Nous vous encourageons à lire les avis et à choisir des trajets qui vous conviennent le mieux.</p>
        </div>

    </div>

</body>
<script>
    function filtrarTarjetas() {
        let input = document.getElementById("buscador").value.toLowerCase();
        let tarjetas = document.querySelectorAll(".card");

        tarjetas.forEach((tarjeta) => {
            let texto = tarjeta.textContent.toLowerCase();
            if (texto.includes(input)) {
                tarjeta.style.display = "block";
            } else {
                tarjeta.style.display = "none";
            }
        });
    }
</script>
<footer>
    <?php include './inc/foot.php'; ?>
</footer>
</html>
