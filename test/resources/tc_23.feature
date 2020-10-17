# language: fr
Fonctionnalité: Se connecter en tant qu'administrateur

  Scénario: Se connecter en tant que client
    Etant donné l'utilisateur est un administrateur
    Et L'utilisateur est sur la page de connexion
    Et L'utilisateur entre son adresse mail
    Et L'utilisateur entre son mot de passe
    Quand Clique sur le bouton "Se connecter"
    Alors L'utilisateur est identifié sur le site
  
  Scénario: Echec connexion e-mail
    Etant donné l'utilisateur est un administrateur
    Et L'utilisateur est sur la page de connexion
    Et L'utilisateur se trompe d'adresse mail
    Et L'utilisateur entre son mot de passe
    Quand L'utilisateur clique sur le bouton "Se connecter"
    Alors L'utilisateur reçoit un message d'erreur approprié
  
  Scénario: Echec connexion mot de passe
    Etant donné l'utilisateur est un administrateur
    Et L'utilisateur est sur la page de connexion
    Et L'utilisateur entre son adresse mail
    Et L'utilisateur se trompe de mot de passe
    Quand L'utilisateur clique sur le bouton "Se connecter"
    Alors L'utilisateur reçoit un message d'erreur approprié