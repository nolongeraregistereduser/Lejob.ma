## Modélisation UML - LeJob.ma

### 1. Modèle Conceptuel de Données (MCD)

#### Entités Principales :
- **Utilisateur** (id, nom, prénom, email, mot de passe, rôle)
- **CV** (id, utilisateur_id, template, date_création)
- **OffreEmploi** (id, recruteur_id, titre, description, catégorie, localisation, type, date_publication)
- **Candidature** (id, offre_id, utilisateur_id, date)
- **Consultant** (id, utilisateur_id, spécialité, tarif_horaire)
- **Reservation** (id, consultant_id, utilisateur_id, date, statut)
- **Feedback** (id, reservation_id, note, commentaire)
- **Admin** (id, utilisateur_id, privilèges)

#### Relations :
- Un **Utilisateur** peut avoir plusieurs **CV**
- Un **Recruteur** (Utilisateur) peut publier plusieurs **Offres d'emploi**
- Un **Chercheur d'emploi** (Utilisateur) peut postuler à plusieurs **Offres d'emploi** via **Candidature**
- Un **Consultant** (Utilisateur) peut avoir plusieurs **Réservations**
- Un **Feedback** est associé à une **Reservation**
- Un **Admin** peut modérer les **Offres d'emploi** et gérer les **Utilisateurs**

---

### 2. Cas d'utilisation (Use Cases)

#### Acteurs :
- **Chercheur d'emploi**
- **Recruteur**
- **Consultant**
- **Administrateur**

#### Cas d'utilisation principaux :

1. **Authentification & Gestion des Comptes**
   - Inscription (Chercheur/Recruteur/Consultant)
   - Connexion / Déconnexion
   - Modification du profil
   - Gestion des rôles (Admin)




2. **Gestion des CV**
   - Création et modification d'un CV
   - Choix d'un template
   - Exportation en PDF

3. **Gestion des Offres d'Emploi**
   - Publication d'une offre d'emploi (Recruteur)
   - Recherche et filtrage des offres (Chercheur d'emploi)
   - Candidature à une offre
   
4. **Système de Réservation (Consultant)**
   - Prise de rendez-vous avec un consultant
   - Gestion des disponibilités (Consultant)
   - Annulation de rendez-vous
   
5. **Gestion des Feedbacks**
   - Ajout d'un avis après une session avec un consultant
   - Affichage des notes et avis

6. **Administration**
   - Gestion des utilisateurs
   - Modération des offres d'emploi
   - Gestion des templates de CV
   - Consultation des statistiques de la plateforme

