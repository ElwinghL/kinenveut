# language: fr
Fonctionnalité: S'inscrire à une enchère privée
  
  Scénario: Inscription à une enchère privée
    Etant donné L'utilisateur est normal
    Et L'utilisateur est connecté
    Et l'utilisateur est sur la page de recherche
    Et l'utilisateur a recherché des enchères privées
    Quand l'utilisateur clique sur le bouton d'inscription à une enchère privée
    Et l'enchère est ouverte
    Alors une demande d'inscription est envoyée à l'administrateur de l'enchère