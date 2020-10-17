# language: fr
Fonctionnalité: Creer un compte
  
  Scénario: Creer un compte utilisateur.
    Etant donné L'utilisateur est sur la page de création de compte.
    Quand L'utilisateur renseigne les champs de saisies.
    Et L'utilisateur valide son inscription.
    Alors Le compte de l'utilisateur est enregistré.
  
  Scénario: Echec adresse mail déjà enregistrer
    Etant donné L'utilisateur est normal
    Et L'utilisateur est sur la page de création de compte.
    Quand L'utilisateur renseigne les champs de saisies.
    Et L'utilisateur valide son inscription.
    Alors L'utilisateur reçoit un message d'erreur approprié.