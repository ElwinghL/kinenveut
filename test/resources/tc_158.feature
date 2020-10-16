# language: fr
Fonctionnalité: Bannissement d'un utilisateur
  
  Plan du Scénario: suppression d'un utilisateur
    Etant donné l'utilisateur est un administrateur
    Et l'utilisateur se connecte
    Et l'utilisateur consulte les users
    Et la liste des users contient "<nom>"
    Quand l'admin bannit "<nom>"
    Alors l'utilisateur "<nom>" est banni
    Exemples:
      | nom           |
      | Auréchou      |
      | Waxel         |
      | Gauthier      |
    
  Scénario:
    Etant donné l'utilisateur est un administrateur
    Et l'utilisateur se connecte
    Etant donné l'utilisateur toto a une enchère
    Quand l'admin bannit toto
    Alors les offres de toto sont supprimées
    Et les enchères de toto sont supprimées