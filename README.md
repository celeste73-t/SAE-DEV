https://github.com/celeste73-t/SAE-DEV

# Appli de Vote Musical

## Description du projet
Ce projet est une **application de vote musical** développée dans le cadre d’un **projet tutoré**.  

## Éléments techniques

### Langage et Architecture
- **PHP** (Programmation orientée objet)
- **Architecture MVC** (Model – View – Controller)

### Architecture
- **Model** : Gestion des données, accès à la base via DAO, définition des entités (Musique, Utilisateur, Vote).
- **View** : Interfaces utilisateur en **HTML/CSS**, intégration de styles pour une expérience fluide.
- **Controller** : Logique applicative, gestion des requêtes et des interactions entre modèles et vues.

### Organisation du code
- `controller/` → Contrôleurs pour orchestrer les actions (vote, affichage, résultats).
- `model/` → Classes métiers pour la persistance des données.
- `dao/` → Classes DAO Récupérent les données en base.
- `service/` → Logique métier complémentaire (validation, calcul des résultats).
- `vue/` → Templates et pages HTML/CSS.
- `class/` → Classes utilitaires et constantes.
