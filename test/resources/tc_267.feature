# language: fr
Fonctionnalité: Mettre à jour ses informations personnelles

  Plan du Scénario: Mettre à jour ses informations personnelles
    Etant donné L'utilisateur est normal
    Et L'utilisateur est connecté
    Et L'utilisateur est sur la page de mise à jour de profile
    Et L'utilisateur a entré la valeur "<valeur>" dans le champ "<champ>"
    Quand L'utilisateur valide le formulaire
    Alors Le champ "<champ>" du profile contient la valeur "<valeur>"
    Exemples:
      | champ   | valeur            |
      | nom     | bob               |
      | prénom  | bobby             |
      | adresse | 2 rue de l'avenue |
      | age     | 24                |
      | email   | bobby.bob@bo.com  |
      | pseudo  | bobbybo           |
