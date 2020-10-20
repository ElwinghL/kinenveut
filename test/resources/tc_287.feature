# language: fr
Fonctionnalité: Inviter à une enchère confidentielle
  
  Scénario: Invitation d'une utilisateur à une vente confidentielle
    Etant donné L'utilisateur est normal
    Et L'utilisateur est connecté
    Et l'utilisateur est sur la page de gestion d'une enchère
    Et l'utilisateur est un administrateur de l'enchère
    Quand l'utilisateur choisi un autre utilisateur à inviter
    Et il clique sur le bouton inviter
    Alors cet utilisateur reçoit une invitation
    Et il est ajouté à la liste d'utilisateurs autorisé