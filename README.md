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
│   │   ├── ...
│   ├── css
│   │   └── style.css
│   ├── db.php
│   ├── model
│   │   ├── ...
│   ├── test_js.php
│   ├── tools.php
│   └── view
│       ├── ...
└── test
```

## Installation de l'environnement de dev :

### Pré requis :

- composer

Une fois composer installé, lancer `composer install`

### Définir le .env pour la bdd

À la racine du projet, il y a un fichier `.env.dev` qui est un exemple de fichier qui définis les différentes variables nécessaires pour la bdd. \
Copier ce fichier et renommer le en `.env`, modifier les variables pour qu'elle corresponde à votre BDD

### Formatage

`composer fix-cs` lance php-cs-fixer à chaque changement de fichier

## Modification composer.json dans le cas d'utilisation de prettier avec npm

modifier le fichier dans le cas de l'utilisation de prettier avec npm

```
  "scripts": {
    "fix-cs": [
      "prettier --write .",
      "php-cs-fixer fix ."
    ]
  }
```
