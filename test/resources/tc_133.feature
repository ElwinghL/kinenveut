# language: fr
Fonctionnalité: Récupérer le mot de passe
  
  Scénario: Récupérer le mot de passe
    Etant donné L'utilisateur n'est pas connecté
    Et L'utilisateur à un compte dans la base
    Et L'utilisateur a entré son adresse mail.
    Quand L'utilisateur a oublié son mot de passe
    Alors L'utilisateur recoit un email avec la possibilité de récupérer l'accès à son compte
  
  Scénario: Récupérer le mot de passe
    Etant donné L'utilisateur n'est pas connecté
    Et L'utilisateur n'a pas de compte dans la base
    Et L'utilisateur a entré son adresse mail.
    Quand L'utilisateur a oublié son mot de passe
    Alors L'utilisateur reçoit un message d'erreur approprié.