<?php
$nombre = isset($_GET['nombre']) ? htmlspecialchars($_GET['nombre']) : 'Usuario';
$apellidoPat = isset($_GET['apellidoPat']) ? htmlspecialchars($_GET['apellidoPat']) : '';
$email = isset($_GET['email']) ? htmlspecialchars($_GET['email']) : '';

$proveedorCorreo = "https://outlook.office.com/mail/"; // Valor predeterminado para otros correos

if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $emailParts = explode('@', $email);
    if (count($emailParts) == 2) {
        $dominio = strtolower($emailParts[1]); // Convertimos a minúsculas para evitar errores
        switch ($dominio) {
            case 'gmail.com':
                $proveedorCorreo = "https://mail.google.com/";
                break;
            case 'hotmail.com':
            case 'outlook.com':
            case 'live.com':
                $proveedorCorreo = "https://outlook.live.com/";
                break;
            case 'yahoo.com':
                $proveedorCorreo = "https://mail.yahoo.com/";
                break;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vérifiez votre e-mail</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(135deg, #ff7eb3, #ff758c);
            text-align: center;
            color: white;
            margin: 0;
        }
        .container {
            background: rgba(255, 255, 255, 0.2);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }
        h1 {
            font-size: 2em;
        }
        p {
            font-size: 1.2em;
            margin: 10px 0;
        }
        .icon {
            font-size: 50px;
        }
        .btn {
            display: inline-block;
            background: white;
            color: #ff758c;
            padding: 10px 20px;
            text-decoration: none;
            font-size: 1.2em;
            border-radius: 5px;
            transition: 0.3s;
        }
        .btn:hover {
            background: #ffb3c1;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="icon">📩</div>
        <?php echo "<h1>¡Bonjour, $nombre $apellidoPat!</h1>"; ?>
        <?php echo "<p>Nous avons envoyé un e-mail de confirmation à <strong>$email</strong>.</p>"; ?>
        <p>Veuillez vérifier votre boîte de réception et cliquer sur le lien de confirmation.</p>
        <p>Si vous ne trouvez pas l'e-mail, vérifiez votre dossier de spam ou de courrier indésirable.</p>
        <p>Merci de votre inscription !</p>
        <a href="<?= htmlspecialchars($proveedorCorreo) ?>" class="btn" target="_blank">Allez sur mon email</a>
    </div>
</body>
</html>
