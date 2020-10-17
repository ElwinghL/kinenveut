# language: fr
Fonctionnalité: Supprimer son compte
  
  Scénario: Supprimer son compte utilisateur
    Etant donné L'utilisateur est normal
    Et L'utilisateur est connecté
    Quand L'utilisateur valide le formulaire
    Et Qu'il valide la confirmation
    Alors Son compte est supprimé