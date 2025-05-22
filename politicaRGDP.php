
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Politique de Confidentialité</title>
    <style>
     
        /* Mobile-first styling */
        body {
            
            margin: auto;
            
            padding: 10px;
            overflow-x: hidden; /* Evitar desbordamiento horizontal */
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
        .policy-container {
            margin-top: 10px;
            margin-left: 100px;
            margin: 7%;
            padding: 10%;
            width: 50%;
            height: 40%;
            overflow-y: auto;
            border: 1px solid #ccc;
            padding: 15px;
            background: rgba(0, 0, 0, 0.3);
            color: #FFFFFF ;
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
</head>
<body>

    <h1>Politique de Confidentialité</h1>
    
    <div class="policy-container">
        <p>
            Bienvenue sur EcoRide, votre application de covoiturage responsable. 
            Cette politique de confidentialité explique comment nous collectons, utilisons et protégeons les données personnelles 
            de nos utilisateurs conformément au Règlement Général sur la Protection des Données (RGPD).
        </p>

        <h2>1. Introduction</h2>
        <p>Chez EcoRide, la confidentialité de vos données personnelles est une priorité. Nous nous engageons à respecter les normes du RGPD et toute autre réglementation applicable en matière de protection des données.</p>

        <h2>2. Données que nous collectons</h2>
        <p>Nous collectons et traitons les données suivantes :</p>
        <ul>
            <li><strong>Données d'identification :</strong> Nom, prénom, adresse email, mot de passe crypté, photo de profil.</li>
            <li><strong>Données de contact :</strong> Numéro de téléphone, adresse email.</li>
            <li><strong>Données de covoiturage :</strong> Lieux de départ et d’arrivée, trajets effectués, horaires, préférences de transport.</li>
            <li><strong>Données techniques :</strong> Adresse IP, type d’appareil, système d’exploitation, données de géolocalisation (si activée).</li>
            <li><strong>Données de paiement :</strong> Informations de paiement traitées de manière sécurisée via nos prestataires conformes au RGPD.</li>
        </ul>

        <h2>3. Finalité du traitement des données</h2>
        <p>Vos données sont utilisées pour :</p>
        <ul>
            <li>Permettre l'organisation et la gestion des trajets de covoiturage.</li>
            <li>Mettre en relation conducteurs et passagers de manière sécurisée.</li>
            <li>Améliorer l’expérience utilisateur et les fonctionnalités de l'application.</li>
            <li>Assurer la sécurité des utilisateurs (vérifications, modération, support).</li>
            <li>Respecter les obligations légales et réglementaires en vigueur.</li>
        </ul>

        <h2>4. Base légale du traitement</h2>
        <p>Le traitement des données repose sur :</p>
        <ul>
            <li><strong>Consentement :</strong> Lorsque vous créez un compte et acceptez nos conditions d’utilisation.</li>
            <li><strong>Obligations contractuelles :</strong> Pour vous fournir les services de covoiturage proposés par EcoRide.</li>
            <li><strong>Intérêts légitimes :</strong> Pour garantir la sécurité, prévenir les fraudes et améliorer nos services.</li>
        </ul>

        <h2>5. Droits des utilisateurs</h2>
        <p>Conformément au RGPD, vous avez les droits suivants :</p>
        <ul>
            <li><strong>Droit d'accès :</strong> Accéder aux données personnelles que nous détenons sur vous.</li>
            <li><strong>Droit de rectification :</strong> Corriger les informations inexactes ou incomplètes.</li>
            <li><strong>Droit à l'effacement :</strong> Demander la suppression de vos données dans certaines circonstances.</li>
            <li><strong>Droit à la limitation :</strong> Restreindre temporairement le traitement de vos données dans certains cas.</li>
            <li><strong>Droit à la portabilité :</strong> Recevoir vos données dans un format structuré ou les transmettre à un autre service.</li>
            <li><strong>Droit d'opposition :</strong> Vous opposer au traitement de vos données pour certains usages.</li>
        </ul>

        <div class="checkbox-container">
            <label>
                <input type="checkbox" id="acceptPolicy"> J'accepte la politique de confidentialité
            </label>
        </div>

        <div class="btn-container">
            <button id="nextButton" disabled>Suivant</button>
        </div>
    </div>

    <script>
        const checkbox = document.getElementById('acceptPolicy');
        const nextButton = document.getElementById('nextButton');

        // Deshabilitar el botón hasta que se seleccione el checkbox
        checkbox.addEventListener('change', function() {
            if (this.checked) {
                nextButton.disabled = false;
                nextButton.classList.add('active');
            } else {
                nextButton.disabled = true;
                nextButton.classList.remove('active');
            }
        });

        // Redireccionar al hacer clic en "Suivant"
        nextButton.addEventListener('click', function() {
            if (!this.disabled) {
                 window.location.href='./registroCorto.php'; // Cambia esto a la URL correspondiente
            }
        });
    </script>

</body>

