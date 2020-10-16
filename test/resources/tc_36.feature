# language: fr
Fonctionnalité: Accès à la page admin sans authentification
  
Scénario: Accès à la page admin sans authentification
  Etant donné L'utilisateur est sur la page de connexion admin
  Quand l'utilisateur tente d'entrer sans nom d'utilisateur ou mot de passe
  Alors l'accès admin est refusé