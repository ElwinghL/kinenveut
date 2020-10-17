# language: fr
Fonctionnalité: Modifier les informations d'une enchère

  Scénario: Mettre à jour les informations d'une enchère
    Etant donné L'utilisateur est normal
    Et L'utilisateur est connecté
    Et l'utilisateur est sur la page de gestion d'une enchère
    Et l'utilisateur est un administrateur de l'enchère ciblée
    Quand l'utilisateur modifie les données de l'enchère 
    Et L'utilisateur valide le formulaire
    Et l'enchère existe
    Alors cette enchère est mise à jour