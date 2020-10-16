# language: fr
Fonctionnalité: Accès à la page admin invalide

  Scénario: Accès à la page admin invalide
    Etant donné L'utilisateur est sur la page de connexion admin
    Quand l'utilisateur entre une paire nom/mdp invalide
    Alors l'accès admin est refusé