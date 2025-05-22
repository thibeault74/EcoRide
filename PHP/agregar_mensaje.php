<?php
require_once '../inc/conexion.php';
require_once '../inc/functions.php';
require '../vendor/autoload.php'; // Cargar PHPMailer

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nombre = limpiar_cadena($_POST['nombre']);
    $email = limpiar_cadena($_POST['email']);
    $mensaje = limpiar_cadena($_POST['mensaje']);
    $fecha = date('Y-m-d H:i:s');

    // Validar email
   if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Correo electrónico no válido.";
        exit;
    }

    // Verificar si el mensaje ya existe en la base de datos
    $stmt_verificar = $conexion->prepare('SELECT 1 FROM mensaje WHERE mensaje = ? AND email = ? LIMIT 1');
    $stmt_verificar->bind_param('ss', $mensaje, $email);
    $stmt_verificar->execute();
    $stmt_verificar->store_result();

    if ($stmt_verificar->num_rows > 0) {
        echo 'Este mensaje ya fue enviado.';
        exit;
    }
    $stmt_verificar->close();

    // Insertar mensaje en la base de datos
    $stmt_insertar = $conexion->prepare('INSERT INTO mensaje (nombre, email, mensaje, fecha) VALUES (?, ?, ?, ?)');
    $stmt_insertar->bind_param('ssss', $nombre, $email, $mensaje, $fecha);

    if ($stmt_insertar->execute()) {
        $stmt_insertar->close();

        // Envío de correo con PHPMailer
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = 'mail.integridadqhse.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'contact@integridadqhse.com';
            //$mail->Password = getenv('MAIL_PASSWORD'); // Usa una variable de entorno
            $mail->Password = 'Prosperidad2023%';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );

            $mail->setFrom('contact@integridadqhse.com', 'integridadQHSE');
            $mail->addAddress($email, $nombre);

            $mail->isHTML(true);
            $mail->Subject = 'IntegridadQHSE - Nuevo mensaje';
            $mail->Body = "
                <html lang='es'>
                <head>
                    <meta charset='UTF-8'>
                    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                    <style>
                        body { font-family: Arial, sans-serif; background-color: #f9f9f9; margin: 0; padding: 0; }
                        .email-container { max-width: 600px; margin: 20px auto; background: #ffffff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); }
                        .email-header { text-align: center; background-color: #4CAF50; color: white; padding: 10px; border-radius: 8px 8px 0 0; }
                        .email-body { padding: 20px; text-align: left; }
                        .email-footer { text-align: center; margin-top: 20px; font-size: 12px; color: #888; }
                        .btn { display: inline-block; background-color: #4CAF50; color: white; text-decoration: none; padding: 10px 20px; border-radius: 5px; font-size: 16px; font-weight: bold; margin-top: 20px; }
                        .btn:hover { background-color: #45a049; }
                        .btn-container { text-align: center; margin-top: 20px; }
                    </style>
                </head>
                <body>
                    <div class='email-container'>
                        <div class='email-header'>
                            <h1>Gracias por tu mensaje</h1>
                        </div>
                        <div class='email-body'>
                            <p>Hola <strong>$nombre</strong>,</p>
                            <p>Gracias por comunicarte conmigo, recibirás una respuesta muy pronto.</p>
                            <p>Si no fuiste tú, ignora este mensaje.</p>
                        </div>
                        <div class='btn-container'>
                            <a href='https://integridadqhse.com' class='btn'>Visitar nuestro sitio</a>
                        </div>
                        <div class='email-footer'>
                            <p>&copy; 2025 Integridad QHSE. Todos los derechos reservados.</p>
                        </div>
                    </div>
                </body>
                </html>
            ";

            $mail->AltBody = "Hola $nombre,\nGracias por tu mensaje. Recibirás una respuesta pronto.\nSi no fuiste tú, ignora este mensaje.";

            $mail->send();
            echo "Registro exitoso. Revisa tu correo para confirmar tu cuenta.";
        } catch (Exception $e) {
            echo "Registro exitoso, pero hubo un error al enviar el correo: {$mail->ErrorInfo}";
        }
    } else {
        echo 'Error al registrar: ' . $stmt_insertar->error;
    }

    $conexion->close();
}
?>
