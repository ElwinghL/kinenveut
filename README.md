# kinenveut

## Installation de l'environnement de dev :

### Pré requis :

- composer

`composer install`

### Définir le .env

À la racine du projet, il y a un fichier `.env.dev` qui est un exemple de fichier qui définis les différentes variables nécessaires pour la bdd. \
Copier ce fichier et renommer le en `.env`, modifier les variables pour qu'elle corresponde à votre BDD

## Script

`composer fix-cs` lance php-cs-fixer à chaque changement de fichier

## composer.json

modifier le fichier dans le cas de l'utilisation de prettier avec npm

```
  "scripts": {
    "fix-cs": [
      "prettier --write .",
      "php-cs-fixer fix ."
    ]
  }
```
