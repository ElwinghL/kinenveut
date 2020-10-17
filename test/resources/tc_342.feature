# language: fr
Fonctionnalité: Mettre fin à une enchère 

  Scénario: Clôturer une enchère
    Etant donné L'utilisateur est normal
    Et L'utilisateur est connecté
    Et l'utilisateur est sur la page de gestion d'une enchère
    Et l'utilisateur est un administrateur de cette enchère
    Quand l'utilisateur clique sur le bouton de clôture d'une enchère
    Et l'enchère existe
    Et l'enchère est ouverte
    Alors cette enchère est close