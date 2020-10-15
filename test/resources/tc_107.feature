# language: fr
Fonctionnalité: Filtrer les acheteurs inscrits à une enchère privée
  
  Scénario: Ejection d'un utilisateur inscrit
    Etant donné l'utilisateur est sur la page de gestion d'une enchère
    Et l'utilisateur est un administrateur de l'enchère
    Quand l'utilisateur clique sur le bouton d'éjection d'un acheteur
    Alors cet acheteur ne fait plus partie de l'enchère
    Et l'acheteur éjecté n'y a plus accès
  
  Scénario: Levée d'un bannissement
    Etant donné l'utilisateur est sur la page de gestion d'une enchère
    Et l'utilisateur est un administrateur de l'enchère
    Quand l'utilisateur clique sur le bouton de suppression du bannissement d'un acheteur
    Alors cet acheteur a de nouveau accès à l'enchère