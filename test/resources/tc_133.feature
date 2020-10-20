# language: fr
Fonctionnalité: Récupérer le mot de passe
  
  Scénario: Récupérer le mot de passe
    Etant donné L'utilisateur n'est pas connecté
    Et L'utilisateur à un compte dans la base
    Et L'utilisateur a entré son adresse mail.
    Quand il clique sur oublie de mot de passe
    Alors L'utilisateur recoit un email avec la possibilité de récupérer l'accès à son compte
  
  Scénario: Récupérer le mot de passe
    Etant donné L'utilisateur n'est pas connecté
    Et L'utilisateur n'a pas de compte dans la base
    Et L'utilisateur a entré son adresse mail.
    Quand il clique sur se connecter
    Alors L'utilisateur reçoit un message lui indiquant qu'aucune adresse mail ne corresponds à l'adresse mail saisie