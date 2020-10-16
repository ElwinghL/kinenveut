# language: fr
Fonctionnalité: Création d'une enchère échec
  
Scénario: Création d'une enchère avec des données invalides
  Etant donné l'utilisateur est sur la page de création d'enchère
  Quand l'utilisateur valide son enchère
  Et les données de l'enchère sont invalides
  Alors l'enchère n'est pas créée