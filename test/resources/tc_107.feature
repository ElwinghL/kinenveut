# language: fr
Fonctionnalité: Filtrer les acheteurs inscrits à une enchère privée
  
  Scénario: Refuser l'inscription d'un utilisateur à l'enchère
    Etant donné l'utilisateur est un administrateur
    Et L'utilisateur est connecté
    Et l'utilisateur est un administrateur de l'enchère
    Et il accèdes à la page des demandes d'accès à ses enchères
    Quand l'utilisateur clique sur le bouton d'éjection d'une personne ayant demandée à participer à l'enchère 
    Alors cette personne est refusée 
    Et ne peut pas participer à cette enchère privée
    
  Scénario: Accepter l'inscription d'un utilisateur à l'enchère
    Etant donné l'utilisateur est un administrateur
    Et L'utilisateur est connecté
    Et l'utilisateur est un administrateur de l'enchère
    Et il accèdes à la page des demandes d'accès à ses enchères
    Quand l'utilisateur clique sur le bouton d'acceptation d'une personne ayant demandée à participer à l'enchère 
    Alors cette personne est acceptée 
    Et peut alors participer à cette enchère privée 