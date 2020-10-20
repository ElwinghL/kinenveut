# language: fr
Fonctionnalité: Enchérir avec un montant exact
  
  Scénario: Enchérir à une enchère
    Etant donné L'utilisateur est normal
    Et L'utilisateur est connecté
    Et l'utilisateur est sur la page d'une enchère
    Et l'enchère est ouverte
    Et l'utilisateur peut participer à l'enchère
    Et l'utilisateur a entré un montant valide
    Quand l'utilisateur clique sur le bouton pour enchérir
    Alors l'enchère de l'utilisateur est acceptée