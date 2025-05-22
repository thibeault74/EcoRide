<style>
        /* Mobile-first styling */
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

        h1 {
            text-align: center;
            font-size: 1.7em;
            color: #000000;
            margin: 0.5em 0;
            margin-bottom: 20px;
        }

        h2 {
            font-size: 1.4em;
            margin-top: 20px;
            margin-bottom: 10px;
        }

        p {
            margin-bottom: 5px;
        }
        .mentions-legales-container {
            max-width: 800px;
            width: 90%;
            margin: 40px auto; /* Centrado horizontal */
            padding: 30px;
            overflow-y: auto;
            border: 1px solid #ccc;
            padding: 15px;
            background-color: rgba(55, 89, 255, 0.3);
            color: #000000 ;
            margin-bottom: 20px;
            font-size: 1.2em;
            border-radius: 8px;
        }

        .checkbox-container {
            text-align: center;
            font-size: 1.2em;
        }

        .checkbox-container label {
            color: #FFFFFF;
        }

        .checkbox-container input {
            margin-right: 10px;
        }

        .btn-container {
            text-align: center;
            margin-top: 20px;
        }

        .btn-container button {
            padding: 12px;
            font-size: 1em;
            background-color: grey;
            color: white;
            border: none;
            border-radius: 5px;
            width: 100%; /* Botón ancho completo en móviles */
            max-width: 300px;
            cursor: not-allowed;
        }

        .btn-container button.active {
            background-color: #4CAF50;
            cursor: pointer;
        }

    </style>
    <link rel="stylesheet" href="styleB.css">
</head>
<body>

<div class="mentions-legales-container">
    <h1>Mentions Légales</h1>

    <h2>1. Éditeur du site</h2>
    <p>
        Nom de l'entreprise : <strong>Ecoride</strong><br>
        Forme juridique : <strong>SAS</strong><br>
        Siège social : <strong>12 rue des Mobilités, 75010 Paris, France</strong><br>
        Numéro SIRET : <strong>123 456 789 00012</strong><br>
        RCS : <strong>Paris B 123 456 789</strong><br>
        Directeur de la publication : <strong>Jean Dupont</strong><br>
        Email de contact : <a href="mailto:contact@ecoride.fr">contact@ecoride.fr</a>
    </p>

    <h2>2. Hébergement</h2>
    <p>
        Hébergeur : <strong>OVH</strong><br>
        Adresse : <strong>2 rue Kellermann, 59100 Roubaix, France</strong><br>
        Téléphone : <strong>1007</strong><br>
        Site web : <a href="https://www.ovh.com" target="_blank">www.ovh.com</a>
    </p>

    <h2>3. Conception et développement</h2>
    <p>
        Développement : <strong>Équipe Ecoride</strong><br>
        Contact technique : <a href="mailto:tech@ecoride.fr">tech@ecoride.fr</a>
    </p>

    <h2>4. Propriété intellectuelle</h2>
    <p>
        Tous les éléments du site Ecoride (textes, images, logos, icônes, sons, logiciels, etc.) sont la propriété exclusive de Ecoride, sauf mentions contraires. 
        Toute reproduction, représentation, modification, publication, adaptation de tout ou partie des éléments du site, quel que soit le moyen ou le procédé utilisé, est interdite sans l'autorisation écrite préalable de Ecoride.
    </p>

    <h2>5. Données personnelles</h2>
    <p>
        Conformément au Règlement Général sur la Protection des Données (RGPD) et à la loi Informatique et Libertés, vous disposez des droits suivants sur vos données personnelles : accès, rectification, effacement, limitation, portabilité, opposition.
        <br><br>
        Pour exercer ces droits ou poser une question sur le traitement de vos données, vous pouvez contacter notre Délégué à la Protection des Données (DPO) à l'adresse suivante : 
        <a href="mailto:dpo@ecoride.fr">dpo@ecoride.fr</a>.
    </p>

    <h2>6. Cookies</h2>
    <p>
        Le site utilise des cookies pour améliorer l’expérience utilisateur et réaliser des statistiques de fréquentation. Vous pouvez configurer votre navigateur pour refuser les cookies, ou ajuster vos préférences via le bandeau de consentement affiché lors de votre première visite.
    </p>

    <h2>7. Responsabilité</h2>
    <p>
        Ecoride s’efforce de fournir des informations fiables et à jour. Toutefois, des erreurs ou omissions peuvent se produire. L'utilisateur est invité à vérifier l'exactitude des informations auprès de Ecoride, et à signaler toute erreur qu’il pourrait constater.
    </p>

    <h2>8. Loi applicable</h2>
    <p>
        Le site est soumis au droit français. En cas de litige, les tribunaux français seront seuls compétents.
    </p>
</div>
