<header class="header">
    <div class="logo"><img src="./imagenes/logoEcoRide.png" alt="EcoRide"  width="250" height="40"></div>
    
    <link rel="stylesheet" href="./CSS/menu.css">
    <input type="checkbox" id="toggle" />
    <label for="toggle"><img class="menu" src="./imagenes/menu.svg" alt="menu"></label>
    <nav class="navigation">
        <ul>
            <li><a href="index.php?p=/main">Accueil</a></li>
            <li><a href="#">Trajet</a>
              <ul>
                <li><a href="index.php?p=/trajet">Nouveau trajet</a></li>
                <?php if (isset($_SESSION['usuario_level']) && ($_SESSION['usuario_level'] == 1 || $_SESSION['usuario_level'] == 2)) {?>
                <li><a href="index.php?p=/covoiturage">Nouveau covoiturage</a></li>
                <?php } ?> 
              </ul>
            </li>
            <li><a href="#">Mon espace</a>
                <ul>
                  <li><a href="index.php?p=/politicaRGDP">Inscrivez-vous sur le site</a></li>
                  <li><a href="index.php?p=/inicio_sesion">Accéder à mon compte</a></li>
                  <?php if (isset($_SESSION['usuario_level']) && ($_SESSION['usuario_level'] == 1 || $_SESSION['usuario_level'] == 2 || $_SESSION['usuario_level'] == 3 || $_SESSION['usuario_level'] == 4)) {?>
                  <li><a href="index.php?p=/vehicle">Inscrire mon véhicule</a></li>
                  <?php } ?> 
                </ul>
            </li>

            <li><a href="#">Contact</a>
                <ul>
                    <li><a href="index.php?p=/contacto">Message</a></li>
                </ul>
            </li>
            
            <?php if (isset($_SESSION['usuario_level']) && $_SESSION['usuario_level'] == 4) { ?>
            <li><a href="#">Paramètres</a>
                <ul>
                    <li><a href="#">Dashboard</a>
                        <ul>
                            <li><a href="index.php?p=/Dashboard">Dashboard</a></li>
                        </ul>
                    </li>
                    <li>
                      <a href="#">Graphique</a>
                      <ul>
                          <li><a href="index.php?p=/Dashboard2">Gains/trajet</a></li>
                          <li><a href="index.php?p=/Dashboard">Nombre de abonnés</a></li>
                      </ul>
                    </li>
                </ul>
                <?php } ?> 
                <?php if (isset($_SESSION['usuario_level']) && ($_SESSION['usuario_level'] == 3 || $_SESSION['usuario_level'] == 4)) { ?>
                <ul>
                    <li><a href="#">administration</a>
                        <ul>
                            <li>
                                <a href="#">utilisateurs/véhicules</a>
                                <ul>
                                    <li><a href="index.php?p=/view_usuarios">gérer les utilisateurs</a></li>
                                    <li><a href="index.php?p=/view_voiture">gérer les véhicules</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">Trajet</a>
                                <ul>
                                    <li><a href="index.php?p=/view_traject">gérer les trajet</a></li>
                                    <li><a href="index.php?p=/incluir_localitacions">nouvelle commune</a></li>
                                    
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>
                <?php } ?>
            </li>
            <?php if (isset($_SESSION['usuario_level']) && ($_SESSION['usuario_level'] == 1 || $_SESSION['usuario_level'] == 2 || $_SESSION['usuario_level'] == 3 || $_SESSION['usuario_level'] == 4)) {?>
            <li><a href="index.php?p=/logout">Log out</a></li>
            <?php } ?>
        </ul>
    </nav>
</header>

<script>
document.addEventListener("DOMContentLoaded", () => {
  const isPC = () => window.innerWidth >= 1000;
  const menuItems = document.querySelectorAll(".header .navigation ul li");

  menuItems.forEach((item) => {
    const submenu = item.querySelector("ul");

    if (submenu) {
      item.addEventListener("click", (event) => {
        event.stopPropagation(); // Evita que el clic se propague al document

        if (isPC()) {
          // Modo PC: Alterna el submenú sin afectar los otros
          submenu.style.display = submenu.style.display === "block" ? "none" : "block";
        } else {
          // Modo Móvil: Cierra otros submenús antes de abrir este
          const allSubmenus = document.querySelectorAll(".header .navigation ul li ul");
          allSubmenus.forEach((otherSubmenu) => {
            if (otherSubmenu !== submenu) {
              otherSubmenu.style.display = "none"; // Cierra otros submenús
              otherSubmenu.parentElement.classList.remove("active"); // Remueve la clase activa
            }
          });

          // Alterna la visibilidad del submenú actual
          if (submenu.style.display === "block") {
            submenu.style.display = "none"; // Oculta si ya está visible
            item.classList.remove("active"); // Remueve la clase activa
          } else {
            submenu.style.display = "block"; // Muestra el submenú
            item.classList.add("active"); // Agrega la clase activa
          }
        }
      });
    }
  });

  // Cierra todos los submenús si se hace clic fuera del menú
  document.addEventListener("click", () => {
    document.querySelectorAll(".header .navigation ul li ul").forEach((submenu) => {
      submenu.style.display = "none";
      submenu.parentElement.classList.remove("active"); // Remueve la clase activa
    });
  });
});


</script>
