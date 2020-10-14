# language: fr
Fonctionnalité: Validation des enchères
  
  Scénario: validation d'une proposition
    Etant donné L'utilisateur est un admin
    Et l'utilisateur consulte les propositions d'enchères
    Et la liste des propositions d'enchères n'est pas vide
    Quand l'admin valide une proposition d'enchère
    Alors la proposition d'enchère n'est plus à valider
    Et la proposition d'enchère est accessible aux utilisateurs du site
    
  Scénario: refus d'une proposition
    Etant donné L'utilisateur est un admin
    Et l'utilisateur consulte les propositions d'enchères
    Et la liste des propositions d'enchères n'est pas vide
    Quand l'admin refuse une proposition d'enchère
    Alors la proposition d'enchère n'est plus à valider
    Et la proposition d'enchère n'est pas accessible aux utilisateurs du site