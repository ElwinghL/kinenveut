# language: fr
Fonctionnalité: Enchérir avec un montant exact échec

  Scénario: Enchère fermée durant l'action
    Etant donné L'utilisateur est normal
    Et L'utilisateur est connecté
    Et l'utilisateur est sur la page d'une enchère
    Et l'enchère est fermée
    Et l'utilisateur peut participer à l'enchère
    Et l'utilisateur a entré un montant valide
    Quand l'utilisateur clique sur le bouton pour enchérir
    Alors un message d'erreur est affiché

  Scénario: Montant choisi de l'enchère incorrect
    Etant donné L'utilisateur est normal
    Et L'utilisateur est connecté
    Et l'utilisateur est sur la page d'une enchère
    Et l'enchère est ouverte
    Et l'utilisateur peut participer à l'enchère
    Et l'utilisateur a entré un montant invalide
    Quand l'utilisateur clique sur le bouton pour enchérir
    Alors un message d'erreur est affiché
