# language: fr
Fonctionnalité: Creer un compte
  
  Scénario: Creer un compte utilisateur.
    Etant donnée L'utilisateur n'a pas de compte.
    Quand L'utilisateur est sur la page de création de compte.
    Et L'utilisateur renseigne les champs de saisies.
    Et L'utilisateur valide son inscription.
    Alors Le compte de l'utilisateur est enregistré.
  
  Scénario: Echec adresse mail déjà enregistrer
    Etant donnée L'utilisateur possède un compte dans la base
    Quand L'utilisateur est sur la page de création de compte.
    Et L'utilisateur renseigne les champs de saisies.
    Et L'utilisateur valide son inscription.
    Alors L'utilisateur reçoit un message d'erreur approprié.