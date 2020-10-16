# language: fr
Fonctionnalité: Se connecter en tant que client
  
  Scénario: Se connecter en tant que client
    Etant donnée L'utilisateur possède un compte dans la base
    Et L'utilisateur entre son adresse mail et mot de passe dans la page de login
    Quand Clique sur le bouton "Se connecter"
    Alors L'utilisateur est identifié sur le site
  
  Scénario: Echec connexion e-mail
    Etant donnée L'utilisateur possède un compte dans la base
    Et L'utilisateur se trompe d'adresse mail
    Et L'utilisateur entre son mot de passe
    Quand L'utilisateur clique sur le bouton "Se connecter"
    Alors L'utilisateur reçoit un message d'erreur approprié
  
  Scénario: Echec connexion mot de passe
    Etant donnée L'utilisateur possède un compte dans la base
    Et L'utilisateur entre son adresse mail
    Et L'utilisateur se trompe de mot de passe
    Quand L'utilisateur clique sur le bouton "Se connecter"
    Alors L'utilisateur reçoit un message d'erreur approprié
  
  Scénario: Echec connexion pas enregistrer
    Etant donnée L'utilisateur ne possède pas de compte dans la base
    Et L'utilisateur entre son adresse mail
    Et L'utilisateur se trompe de mot de passe
    Quand L'utilisateur clique sur le bouton "Se connecter"
    Alors L'utilisateur reçoit un message d'erreur approprié