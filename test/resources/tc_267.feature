# language: fr
Fonctionnalité: Mettre à jour ses informations personnelles

Scénario: Mettre à jour ses informations personnelles
Etant donnée: L'utilisateur est connecté
Et: L'utilisateur est sur la page de mise à jour de profile
Et: L'utilisateur a entré la valeur <valeur> dans le champ "<champ>"
Quand: L'utilisateur clique sur le bouton "Valider"
Alors: Le champ "<champ>" du profile contient la valeur <valeur>

Examples:
  | champ | valeur |
  | "nom"     | "bob"               |
  | "prénom"  | "bobby"             |
  | "adresse" | "2 rue de l'avenue" |
  | "age"     | 24                  |
  | "email"   | "bobby.bob@bo.com"  |
  | "pseudo"  | "bobbybo"           |