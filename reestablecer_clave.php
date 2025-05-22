<?php
require_once './inc/conexion.php';
require_once './inc/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['token'])) {
    $token = $_GET['token'];

    // Verificar si el token existe y no ha expirado
    $stmt = $conexion->prepare("SELECT id, token_expira FROM usuarios WHERE token = ? AND activo = 1");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $stmt->bind_result($user_id, $token_expira);
        $stmt->fetch();

        // Verificar si el token ha expirado
        if (strtotime($token_expira) >= time()) {
            // Mostrar formulario para nueva contraseña
            ?>
            <!DOCTYPE html>
            <html lang="es">
            <head>
                <meta charset="UTF-8">
                <title>Réinitialiser le mot de passe</title>
            </head>
            <body>
                <h2>Réinitialiser le mot de passe</h2>
                <form action="reestablecer_clave.php" method="post">
                    <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
                    <label for="password">Nouveau mot de passe :</label>
                    <input type="password" name="password" required><br><br><i class="bi bi-eye-slash" id="togglePassword" style="cursor: pointer;"></i>
                    <label for="confirm_password">Confirmez le mot de passe:</label>
                    <input type="password" name="confirm_password" required><br><br><i class="bi bi-eye-slash" id="togglePassword" style="cursor: pointer;"></i>
                    <button type="submit">Restaurer</button>
                </form>
            </body>
            </html>
            <?php
        } else {
            echo "Le lien a expiré. Veuillez en demander un nouveau.";
        }
    } else {
        echo "Token inválido.";
    }
    $stmt->close();
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Procesar nueva contraseña
    $token = $_POST['token'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        echo "Les mots de passe ne correspondent pas.";
        exit;
    }

    // Verificar token nuevamente
    $stmt = $conexion->prepare("SELECT id FROM usuarios WHERE token = ? AND token_expira >= NOW()");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $stmt->bind_result($user_id);
        $stmt->fetch();

        // Actualizar contraseña
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $update = $conexion->prepare("UPDATE usuarios SET password1 = ?, token = NULL, token_expira = NULL WHERE id = ?");
        $update->bind_param("si", $hashed_password, $user_id);

        if ($update->execute()) {
            echo "Mot de passe mis à jour avec succès. <a href='https://www.qhsefrance.com/index.php?p=/inicio_sesion'>Ir al inicio</a>";
        } else {
            echo "Erreur lors de la mise à jour du mot de passe.";
        }
        $update->close();
    } else {
        echo "Jeton invalide ou expiré.";
    }
    $stmt->close();
}
$conexion->close();
?>
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
    </script>