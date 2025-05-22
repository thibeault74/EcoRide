<?php
require_once '../inc/conexion.php';
require '../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];

    // Verifica que el correo existe
    $stmt = $conexion->prepare("SELECT id, nombre FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $stmt->bind_result($id, $nombre);
        $stmt->fetch();

        $token = bin2hex(random_bytes(32));
        $fecha_expira = date("Y-m-d H:i:s", strtotime("+1 hour")); // Expira en 1 hora

        // Guarda el token y la expiración
        $update = $conexion->prepare("UPDATE usuarios SET token = ?, token_expira = ? WHERE id = ?");
        $update->bind_param("ssi", $token, $fecha_expira, $id);
        $update->execute();

        // Enlace para restablecer
        $link = "https://www.qhsefrance.com/reestablecer_clave.php?token=$token";

        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'mail.qhsefrance.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'contact@qhsefrance.com';
            $mail->Password = 'Prosperidad2023';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom('contact@qhsefrance.com', 'QHSE france.com');
            $mail->addAddress($email, $nombre);
            $mail->isHTML(true);
            $mail->Subject = 'Récupération de mot de passe - QHSE france.com';
            $mail->Body = "<p>Bonjour <strong>$nombre</strong>,</p>
                <p>Cliquez sur le lien suivant pour réinitialiser votre mot de passe :</p>
                <p><a href='$link'>$link</a></p>
                <p>Ce lien expirera dans 1 heure.</p>";
            $mail->AltBody = "Bonjour $nombre,\n\nRécupérez votre mot de passe : $link\n\nCe lien expire dans 1 heure.";

            $mail->send();
            echo "Vérifiez votre e-mail pour réinitialiser votre mot de passe.";
        } catch (Exception $e) {
            echo "Erreur lors de l'envoi de l'e-mail : {$mail->ErrorInfo}";
        }
    } else {
        echo "L'email n'est pas enregistré.";
    }

    $stmt->close();
    $conexion->close();
}
?>