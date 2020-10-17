# language: fr
Fonctionnalité: Donner un prix de départ invalide
  
  Scénario: Création d'une enchère avec un prix de départ invalide
    Etant donné L'utilisateur est normal
    Et L'utilisateur est connecté
    Et l'utilisateur est sur la page de création d'enchère
    Quand l'utilisateur entre un prix de départ invalide
    Alors la création d'enchère est impossible