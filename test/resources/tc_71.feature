# language: fr
Fonctionnalité: Recherche d'une enchère par nom

  Scénario: Recherche d'une enchère par nom  
    Etant donné L'utilisateur est normal
    Et L'utilisateur est connecté
    Et L'utilisateur possède au moins une enchère
    Et L'utilisateur est sur la page de recherche
    Quand l'utilisateur tape le nom de son objet dans la barre de recherche
    Et L'utilisateur clique sur le bouton rechercher
    Alors le résultat de sa recherche est affiché