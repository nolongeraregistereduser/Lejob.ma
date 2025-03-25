## Diagramme de Classes - LeJob.ma

### **Classes Principales**

#### **1. Utilisateur**
- **Attributs :**
  - id : int
  - nom : string
  - prenom : string
  - email : string
  - motDePasse : string
  - role : string (Chercheur, Recruteur, Consultant, Admin)

- **Méthodes :**
  - inscrire(nom, prenom, email, motDePasse, role)
  - seConnecter(email, motDePasse)
  - modifierProfil(nom, prenom, email, motDePasse)

---

#### **2. CV**
- **Attributs :**
  - id : int
  - utilisateurId : int
  - template : string
  - dateCreation : Date

- **Méthodes :**
  - creerCV(utilisateurId, template)
  - modifierCV(template)
  - exporterPDF()

---

#### **3. OffreEmploi**
- **Attributs :**
  - id : int
  - recruteurId : int
  - titre : string
  - description : string
  - categorie : string
  - localisation : string
  - type : string (CDI, CDD, Stage, Freelance)
  - datePublication : Date

- **Méthodes :**
  - publierOffre(recruteurId, titre, description, categorie, localisation, type)
  - modifierOffre(titre, description, categorie, localisation, type)
  - supprimerOffre()

---

#### **4. Candidature**
- **Attributs :**
  - id : int
  - offreId : int
  - utilisateurId : int
  - date : Date

- **Méthodes :**
  - postulerOffre(offreId, utilisateurId)
  - annulerCandidature()

---

#### **5. Consultant**
- **Attributs :**
  - id : int
  - utilisateurId : int
  - specialite : string
  - tarifHoraire : float

- **Méthodes :**
  - definirTarif(tarif)
  - mettreAJourSpecialite(specialite)

---

#### **6. Reservation**
- **Attributs :**
  - id : int
  - consultantId : int
  - utilisateurId : int
  - date : Date
  - statut : string (Confirmé, Annulé, En attente)

- **Méthodes :**
  - reserverConsultation(consultantId, utilisateurId, date)
  - annulerReservation()
  - modifierStatut(statut)

---

#### **7. Feedback**
- **Attributs :**
  - id : int
  - reservationId : int
  - note : int
  - commentaire : string

- **Méthodes :**
  - donnerAvis(reservationId, note, commentaire)
  - modifierAvis(note, commentaire)

---

#### **8. Admin**
- **Attributs :**
  - id : int
  - utilisateurId : int
  - privileges : string

- **Méthodes :**
  - gererUtilisateurs()
  - modererOffres()
  - voirStatistiques()

---

Tu peux maintenant ajouter les relations entre ces classes selon ton modèle UML.

