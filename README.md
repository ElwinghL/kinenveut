# kinenveut

## Installation de l'environnement de dev :

### Pré requis :

- npm
- composer

`npm install --global prettier @prettier/plugin-php`\
`composer install`

### Définir le .env

À la racine du projet, il y a un fichier `.env.dev` qui est un exemple de fichier qui définis les différentes variables nécessaires pour la bdd. \
Copier ce fichier et renommer le en `.env`, modifier les variables pour qu'elle corresponde à votre BDD

## Script

`composer fix-cs` lance manuellement prettier et php-cs-fixer
