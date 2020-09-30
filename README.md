# Kinenveut

## Contenu du répertoire

```
kinenveut
├── composer.json
├── composer.lock
├── creation_of_dataBase.sql
├── index.php
├── LICENSE
├── README.md
├── src
│   ├── controller
│   │   ├── Controller.php
│   │   ├── route.php
│   │   ├── ...
│   ├── css
│   │   └── style.css
│   ├── db.php
│   ├── model
│   │   ├── ...
│   ├── service
│   │   ├── bo
│   │   │   ├── App_BoFactory.php
│   │   │   ├── ...
│   │   └── dao
│   │       ├── App_DaoFactory.php
│   │       ├── ...
│   ├── test_js.php
│   ├── tools.php
│   └── view
│       ├── ...
└── test
```

Explication des répertoires principaux du dossier `src` :

- `controller` : contiens tous les contrôleurs ;
- `model` : objet qui transit entre les contrôleurs, les bos et les daos ;
- `service/bo` : bo signifie Business Object, elle traite toute la partie métier, elle peut être appelée par un contrôleur ou un autre bo ;
- `service/dao` : traite toute la partie bdd, elle est appelée par un bo ;
- `view` : contiens toutes les vues.

Pour comprendre, regarde le contrôleur `RegistrationController` qui enregistre un utilisateur

## Installation de l'environnement de dev :

### Pré requis :

- composer

Une fois composer installé, lancer `composer install`

### Définir le .env pour la bdd

À la racine du projet, il y a un fichier `.env.dev` qui est un exemple de fichier qui définis les différentes variables nécessaires pour la bdd. \
Copier ce fichier et renommer le en `.env`, modifier les variables pour qu'elle corresponde à votre BDD

### Formatage

`composer format` lance php-cs-fixer à chaque changement de fichier

### Les testes

`composer test` lance les testes avec php unit

## Modification composer.json dans le cas d'utilisation de prettier avec npm

Ajouter dans `scripts.format` le code `prettier --write .`
