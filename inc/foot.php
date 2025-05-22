<div class="foot_contain" id="footer">
  <p>
    <span class="footer-item">&copy; EcoRide 2025</span>
    <a class="footer-item" href="mailto:contact@ecoride.com">contact@ecoride.com</a>
    <a class="footer-item" href="index.php?p=/legales">Mentions légales</a>
  </p>
  <div class="footer-toggle" id="footerToggle" onclick="toggleFooter()">>>></div>
</div>
<style>
.foot_contain {
  background-color: rgba(55, 89, 255, 0.7);
  color: white;
  text-align: center;
  padding-top: 70px;
  position: fixed;
  bottom: 40;
  left: 0;
  width: 40%;
  height: 20px;
  transition: transform 0.5s ease;
  z-index: 999;
  display: flex;
  align-items: center;
  justify-content: center;
}

.footer-item {
  margin-right: 25px;
}

.foot_contain a {
  color: #8EC742;
  text-decoration: none;
}

.foot_contain a:hover {
  text-decoration: underline;
}

.footer-toggle {
  position: absolute;
  right: 25px;
  top: 50%;
  transform: translateY(50%);
  background-color: rgba(55, 89, 255, 0.8);
  color: white;
  padding: 5px 8px;
  cursor: pointer;
  border-radius: 0 4px 4px 0;
  font-size: 14px;
}


.footer-hidden {
  transform: translateX(-90%);
}
</style>

<script>
let footer = document.getElementById("footer");
let isHidden = false;

// Oculta el footer al hacer scroll
window.addEventListener("scroll", function () {
  if (!isHidden) {
    footer.classList.add("footer-hidden");
    isHidden = true;
  }
});

// Alterna visibilidad al hacer clic en la flecha
function toggleFooter() {
  footer.classList.toggle("footer-hidden");
  isHidden = !isHidden;
}
</script>