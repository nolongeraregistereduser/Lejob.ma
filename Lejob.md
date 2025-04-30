**LeJob.ma Platform**

Site web de recrutement et d'insertion professionnelle

Version : 0.1
## Présentation d'ensemble du projet

LeJob.ma est une plateforme innovante dédiée au recrutement et à l'insertion professionnelle au Maroc. Elle offre un processus complet pour les chercheurs d'emploi, les recruteurs et les consultants en carrière.

### Les objectifs du site

- Faciliter la création de CV professionnels et ATS-friendly
- Connecter les chercheurs d'emploi avec les opportunités du marché
- Permettre l'accès à des consultants en carrière pour du coaching
- Simplifier le processus de recrutement pour les chercheurs d'emplois.

### La cible adressée par le site

- Chercheurs d'emploi (Fresh graduates, professionnels)
- Recruteurs/Entreprises ( API fetchig les offres d'emplois pour cette version)
- Consultants/Coaches en carrière

### Périmètre du projet

- Marché cible : Maroc
- Langues : Français, Arabe, Anglais
- Interface responsive.
- Accessible sur tous les appareils

### Charte graphique

- Couleur principale : [Hex code]
- Couleur secondaire : [Hex code]
- Font principale : [Font name]

## Description fonctionnelle et technique

### Arborescence du site

Pages principales :
- Accueil
- CV Builder
- Offres d'emploi
- Consultants
- Dashboard (selon le type d'utilisateur)
- Profil

### Fonctionnalités principales

**1. CV Builder**
- Création de CV avec React-PDF( à discutter j peux travailler avec Latex ou jsPDF )
- Multiple templates professionnels (2-3 pour commancer apres je vais travailelr sur d'autres templates plus professionelles)
- Export en PDF
- Templates ATS-friendly
- Prévisualisation en temps réel (Non-prioritaire)

**2. Gestion des offres d'emploi**
- Offres d'emplois remote via remotive API.
- Recherche avancée
- Filtrage par catégorie/location/type


**3. Système de Booking**
- Réservation de sessions avec des consultants
- Système de paiement (Stripe)
- Feedback et évaluation

### Technologies utilisées

Frontend:
- HTML/CSS
- JavaScript/React
- React-PDF pour la génération de CV
- Tailwind pour le design responsive

Backend:
- PHP/Laravel
- MySQL
- API RESTful

## User Stories

**Chercheur d'emploi**
- Je peux créer un compte et gérer mon profil
- Je peux créer et modifier mon CV avec différents templates
- Je peux rechercher et postuler aux offres d'emploi
- Je peux réserver des sessions avec des consultants


**Consultant**
- Je peux créer mon profil de consultant
- Je peux gérer mes réservations
- Je peux communiquer avec mes clients ( Via Mail)

**Admin**
- Je peux gérer tous les utilisateurs
- Je peux modérer les offres d'emploi
- Je peux gérer les templates de CV
- Je peux voir les statistiques de la plateforme

## Backlog

### Epic 1: Système d'authentification
- Mise en place du système d'authentification complet
- Gestion des différents rôles (chercheur, recruteur, consultant, admin)
- Gestion des profils utilisateurs

### Epic 2: CV Builder
- Implémentation du système de création de CV avec React-PDF
- Création des templates ATS-friendly
- Système d'export et de sauvegarde des CV

### Epic 3: Gestion des offres
- Système de publication et gestion des offres d'emploi (Remotive API)
- Mise en place du système de recherche et filtrage

### Epic 4: Système de Booking
- Mise en place du système de réservation
- Integration du Paiment via Stripe
- Système de feedback

### Epic 5: Admin Dashboard
- Interface d'administration
- Gestion des utilisateurs et modération
- Système de reporting et statistiques

### Epic 6: Testing & Optimization
- Tests et débogage
- Optimisation des performances
- Documentation


