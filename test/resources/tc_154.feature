# language: fr
Fonctionnalité: Consulter la liste des utilisateurs en attente de validation d'inscription

Scénario: Consultation des utilisateurs en attente de validation
  Etant donné que l'utilisateur est un administrateur
  Et que l'utilisateur se connecte
  Et qu' il existe un ou plusieurs membres en attente de validation d'inscription
  Quand l'utilisateur consulte la liste des utilisateurs en attente d'inscription
  Alors la liste des utilisateurs est visible