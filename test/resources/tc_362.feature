# language: fr
Fonctionnalité: Validation d'un utilisateur
  
  Scénario: Validation d'un nouvel utilisateur
    Etant donné L'utilisateur est un admin
    Et l'utilisateur consulte les users
    Et une demande d'inscription est présente
    Quand l'admin valide l'inscription
    Alors l'inscription de l'utilisateur devient effective