# language: fr
Fonctionnalité: Enchérir avec un montant exact échec
  
  Scénario: Enchère fermée durant l'action
    Etant donnée L'utilisateur est connecté.
    Et l'utilisateur est sur la page d'une enchère
    Et l'utilisateur peut participer à l'enchère
    Et l'utilisateur a entré au préalable le montant de l'enchère
    Quand l'utilisateur clique sur le bouton d'envoi de l'enchère
    Et l'utilisateur a choisi un montant valide
    Et l'enchère est fermée
    Alors un message d'erreur est affiché
    
  Scénario: Montant choisi de l'enchère incorrect
    Etant donnée L'utilisateur est connecté.
    Et l'utilisateur est sur la page d'une enchère
    Et l'utilisateur peut participer à l'enchère
    Et l'utilisateur a entré au préalable le montant de l'enchère
    Quand l'utilisateur clique sur le bouton d'enchère
    Et l'utilisateur a choisi un montant invalide
    Et l'enchère est ouverte
    Alors un message d'erreur est affiché