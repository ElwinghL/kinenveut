# language: fr
Fonctionnalité: Consultation
  
Scénario: Consultation publique
  Etant donné L'utilisateur est un admin
  Et l'utilisateur est connecté sur la page admin
  Quand l'utilisateur consulte la liste des enchères
  Alors la liste des enchères publiques est visible
  
Scénario: Consultation privée
  Etant donné L'utilisateur est un admin
  Et l'utilisateur est connecté sur la page admin
  Quand l'utilisateur consulte la liste des enchères
  Alors la liste des enchères privées est visible
  
Scénario: Consultation confidentielle
  Etant donné L'utilisateur est un admin
  Et l'utilisateur est connecté sur la page admin
  Quand l'utilisateur consulte la liste des enchères
  Alors la liste des enchères confidentielles est visible
