# language: fr
Fonctionnalité: Suppression d'une catégorie
  
  Plan du Scénario: Mise à jour des catégories
    Etant donné l'utilisateur est un administrateur
    Et L'utilisateur est connecté
    Et l'utilisateur consulte les catégories d'enchères
    Et la liste de catégories contient "<nom>"
    Quand l'utilisateur supprime la catégorie "<nom>"
    Alors les enchères avec la catégorie "<nom>" sont remis à la catégorie par défaut
    Exemples:
      | nom        |
      | cuisine    |
      | autres     |
      | encombrant |
  
  Scénario: Suppression de la catégorie par défaut
    Etant donné l'utilisateur est un administrateur
    Et L'utilisateur est connecté
    Et l'utilisateur consulte les catégories d'enchères
    Quand l'utilisateur veut supprimer la catégorie par défaut
    Alors la suppression ne fonctionne pas