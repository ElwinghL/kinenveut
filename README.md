# Kinenveut

## Contenu du répertoire

```
kinenveut
├── composer.json
├── index.php
├── insertion_of_test_values.sql
├── LICENSE
├── patch
│   └── ...
├── phpunit.xml
├── README.md
├── resources
│   ├── ...
├── src
│   ├── controller
│   │   └── ...
│   ├── css
│   │   └── style.css
│   ├── db.php
│   ├── exception
│   │   └── ...
│   ├── model
│   │   └── ...
│   ├── service
│   │   ├── bo
│   │   │   └── ...
│   │   └── dao
│   │       └── ...
│   ├── tools.php
│   └── view
│       └── ...
├── test
│   └── ...
├── update_bdd.sh
└── watch.bat
```

Explication des répertoires principaux du dossier `src` :

- `controller` : contiens tous les contrôleurs ;
- `model` : objet qui transit entre les contrôleurs, les bos et les daos ;
- `service/bo` : bo signifie Business Object, elle traite toute la partie métier, elle peut être appelée par un contrôleur ou un autre bo ;
- `service/dao` : traite toute la partie bdd, elle est appelée par un bo ;
- `view` : contiens toutes les vues ;
- `exception` : contiens tous les exceptions.

`test` : contiens touts les tests ;\
`patch` : contiens tous les patchs mysql.

## Installation de l'environnement de dev :

### Pré requis :

- composer

Une fois composer installé, lancer `composer install`

### Définir le .env pour la bdd

À la racine du projet, il y a un fichier `.env.dev` qui est un exemple de fichier qui définis les différentes variables nécessaires pour la bdd. \
Copier ce fichier et renommer le en `.env`, modifier les variables pour qu'elle corresponde à votre BDD

### Script bdd

Ajouter à votre bdd les patchs :

- 000 si vous voulez créer un database par défault
- le patch 001

Lancer ensuite le script `sh update_bdd.sh` il va lancer tous les patchs suivant.
script à faire à chaque pull pour passer automatiquement les nouveaux patchs.

### Script composer

`composer format` lance php-cs-fixer à chaque changement de fichier \
`composer test` lance les tests avec php unit \
`composer coverage` lance la couverture des tests dans le terminal \
`composer coverage-html` lance la couverture des tests en html dans le dossier `/test/coverage/`
