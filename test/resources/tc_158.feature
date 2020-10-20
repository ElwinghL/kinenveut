# language: fr
Fonctionnalité: Bannissement d'un utilisateur

  Scénario: Bannissement d'un utilisateur
    Etant donné l'utilisateur est un administrateur
    Et L'utilisateur est connecté
    Quand l'administrateur banni un utilisateur
    Alors les offres en cours de l'utilisateur sont supprimées
    Et les enchères de l'utilisateur sont supprimées
