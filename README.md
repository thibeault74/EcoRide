EcoRide – Application de Covoiturage

**EcoRide** est une application web de **covoiturage**, développée dans le cadre de la formation professionnelle Full Stack. Elle permet de connecter conducteurs et passagers pour partager des trajets et réduire leur empreinte écologique.

Technologies utilisées

- HTML / CSS / JavaScript (Frontend)
- PHP (Backend)
- MySQL (Base de données)
- Laragon (Serveur local de développement)
- PHPMailer (pour l’envoi d’e-mails, dossier `/vendor`)

Structure du projet
/CSS → Feuilles de style
/grafic → Graphiques (backend)
/inc → Composants réutilisables (head, menu, footer, session)
/PHP → Logique backend (contrôleurs, traitements)
/vistas → Pages frontend
/vendor → Librairies externes pour e-mails
/ecoride.sql → Script SQL de création de la base de données

Installation en local

Prérequis

- [Laragon](https://laragon.org/)
- PHP ≥ 7.4
- MySQL
- Navigateur web moderne

Étapes

1. Cloner ce dépôt :

```bash
git clone https://github.com/votre-utilisateur/ecoride.git

copier le projet dans le dossier www de Laragon.

Importer la base de données ecoride.sql via phpMyAdmin ou la console MySQL :
mysql -u root < ecoride.sql

Comptes de test

Type d’utilisateur	Email	Mot de passe
Administrateur	thibeault911@gmail.com	Templario74

Fonctionnalités principales
Inscription et connexion des utilisateurs

Recherche de trajets disponibles

Publication de trajets par les conducteurs

Visualisation de statistiques (graphiques)

Gestion des utilisateurs (admin)

Notifications par e-mail


Base de données
Fichier SQL : ecoride.sql

Utilisateur MySQL : root

Mot de passe MySQL : (vide)

Licence
Ce projet a été réalisé dans le cadre d’une formation professionnelle au développement Full Stack. Il est destiné à un usage pédagogique uniquement.