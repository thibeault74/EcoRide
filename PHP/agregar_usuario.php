<?php
require_once '../inc/conexion.php';
require_once '../inc/functions.php';
require '../vendor/autoload.php'; // Cargar PHPMailer

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nombre = $_POST['nombre'];
    $apellidoPat = $_POST['apellidoPat'];
    $fechaNac = $_POST['fechaNac'];
    $telephone = $_POST['telephone'];
    $adresse = $_POST['adresse'];
    $photo = $_POST['photo'];
    $email = $_POST['email'];
    $password1 = $_POST['password1'];
    limpiar_cadena($password1);
    $password1 = password_hash($password1, PASSWORD_DEFAULT);
    $level2 = $_POST['level2'];
    $token = bin2hex(random_bytes(32)); // Genera un token único

    limpiar_cadena($nombre);
    limpiar_cadena($apellidoPat);
    limpiar_cadena($telephone);
    limpiar_cadena($adresse);
    limpiar_cadena($email);

    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === 0) {
        $photoData = file_get_contents($_FILES['photo']['tmp_name']);
        $photoType = $_FILES['photo']['type'];
    } else {
        $photoData = null;
        $photoType = null;
    }

    // Verificar si el correo electrónico ya existe en la base de datos
    $stmt_verificar = $conexion->prepare('SELECT COUNT(*) FROM usuarios WHERE email = ?');
    $stmt_verificar->bind_param('s', $email);
    $stmt_verificar->execute();
    $stmt_verificar->bind_result($num_filas);
    $stmt_verificar->fetch();
    $stmt_verificar->close();

    if ($num_filas > 0) {
        echo 'El correo electrónico ya está registrado.';
    } else {
        // Insertar nuevo usuario si el correo electrónico no está registrado
        $stmt_insertar = $conexion->prepare('INSERT INTO usuarios (nombre, apellidoPat, fechaNac, telephone, adresse, email, password1, level2, token, confirmado, activo, photo_type, photo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 0, 0, ?, ?)');
        $stmt_insertar->bind_param('sssssssssss', $nombre, $apellidoPat, $fechaNac, $telephone, $adresse, $email, $password1, $level2, $token, $photoType, $photoData);
        $stmt_insertar->send_long_data(10, $photoData);

        if ($stmt_insertar->execute()) {
            $confirmLink = "https://www.ecoride.com/confirmar.php?token=$token";
            $mail = new PHPMailer(true);

            try {
                // Configuración del servidor SMTP
                $mail->isSMTP();
                $mail->Host = 'mail.ecoride.com'; // Cambia esto por el servidor SMTP de tu proveedor
                $mail->SMTPAuth = true;
                $mail->Username = 'contact@ecoride.com'; // Tu correo electrónico
                $mail->Password = 'ClaveXXX';          // Contraseña del correo
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587; // Puerto SMTP (puede variar según tu proveedor)
    
                $mail->SMTPOptions = array(
                    'ssl' => array(
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true
                    )
                );

                // Configuración del correo
                $mail->setFrom('contact@ecoride.com', 'ecoride.com'); // Correo del remitente
                $mail->addAddress($email, "$nombre $apellidoPat");  // Correo del destinatario
    
                // Contenido del correo
                $mail->isHTML(true);
                $mail->Subject = 'EcoRide.com Confirmez votre compte';
                $mail->Body = "
                <!DOCTYPE html>
                <html lang='fr'>
                <head>
                    <meta charset='UTF-8'>
                    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                    <style>
                        body {
                            font-family: Arial, sans-serif;
                            line-height: 1.6;
                            color: #333;
                            background-color: #f9f9f9;
                            margin: 0;
                            padding: 0;
                        }
                        .email-container {
                            max-width: 600px;
                            margin: 20px auto;
                            background: #ffffff;
                            border: 1px solid #ddd;
                            border-radius: 8px;
                            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                            padding: 20px;
                        }
                        .email-header {
                            text-align: center;
                            background-color: #4CAF50;
                            color: white;
                            padding: 10px 20px;
                            border-radius: 8px 8px 0 0;
                        }
                        .email-header h1 {
                            margin: 0;
                            font-size: 24px;
                        }
                        .email-body {
                            padding: 20px;
                            text-align: left;
                        }
                        .email-body p {
                            margin: 0 0 15px;
                        }
                        .email-body a {
                            display: inline-block;
                            margin-top: 20px;
                            padding: 10px 20px;
                            background-color: #4CAF50;
                            color: white;
                            text-decoration: none;
                            border-radius: 5px;
                            font-weight: bold;
                        }
                        .email-body a:hover {
                            background-color: #45a049;
                        }
                        .email-footer {
                            text-align: center;
                            margin-top: 20px;
                            font-size: 12px;
                            color: #888;
                        }
                    </style>
                </head>
                <body>
                    <div class='email-container'>
                        <div class='email-header'>
                            <h1>Confirmez votre compte</h1>
                        </div>
                        <div class='email-body'>
                            <p>Bonjour <strong>$nombre</strong>,</p>
                            <p>Merci de vous être inscrit auprès de EcoRide Veuillez confirmer votre email en cliquant sur le lien ci-dessous :</p>
                            <a href='$confirmLink'>Confirmez votre email</a>
                            <p>Si ce n’était pas vous, ignorez ce message.</p>
                        </div>
                        <div class='email-footer'>
                            <p>&copy; 2025 EcoRide.com  Tous droits réservés.</p>
                        </div>
                    </div>
                </body>
                </html>
                ";

                $mail->AltBody = "Bonjour $nombre,\nMerci de votre inscription sur EcoRide.com Veuillez confirmer votre email sur le lien suivant: $confirmLink\nSi ce n’était pas vous, ignorez ce message.";
                    
                $mail->send();
                echo "Inscription réussie.";
            } catch (Exception $e) {
                echo "Erreur lors de l'envoi de l'e-mail: {$mail->ErrorInfo}";
            }
        } else {
            echo 'Erreur lors de inscription: ' . $stmt_insertar->error; 
        }

        $stmt_insertar->close();
    }

    $conexion->close();
}
?>

