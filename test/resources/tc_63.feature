# language: fr
Fonctionnalité: Création d'une enchère échec

  Scénario: Création d'une enchère avec des données invalides
    Etant donné L'utilisateur est normal
    Et L'utilisateur est connecté
    Et l'utilisateur est sur la page de création d'enchère
    Quand l'utilisateur valide son enchère avec les champs invalides
    Alors l'enchère n'est pas créée
