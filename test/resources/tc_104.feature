# language: fr
Fonctionnalité: Modification des catégories existantes
  
  Plan du Scénario: création d'une catégorie
    Etant donné l'utilisateur est un administrateur
    Et L'utilisateur est connecté
    Et l'utilisateur consulte les catégories d'enchères
    Et la liste de catégories est vide
    Quand l'utilisateur ajoute une catégorie avec le nom "<nom>"
    Alors une nouvelle catégorie nommée "<nom>" apparaît
    Exemples:
      | nom     |
      | cuisine |
      | radio   |
      | auto    |

  Plan du Scénario: modification d'une catégorie
    Etant donné l'utilisateur est un administrateur
    Et L'utilisateur est connecté
    Et l'utilisateur consulte les catégories d'enchères
    Et la liste de catégories est vide
    Quand l'utilisateur renomme la catégorie avec le nom "<nom1>" en "<nom2>"
    Alors l'ancienne catégorie "<nom1>" prend le nom "<nom2>"
    Exemples:
      | nom1         | nom2     |
      | cuisinel     | cuisine  |
      | radiophonie  | radio    |
      | concert      | musique  |
     
  Plan du Scénario: suppression d'une catégorie
    Etant donné l'utilisateur est un administrateur
    Et L'utilisateur est connecté
    Et l'utilisateur consulte les catégories d'enchères
    Et la liste de catégories contient "<nom>"
    Quand l'utilisateur supprime la catégorie "<nom>"
    Alors la catégorie "<nom>" disparaît
    Exemples:
      | nom           |
      | cuisine       |
      | téléphone     |
      | jeux vidéos   |