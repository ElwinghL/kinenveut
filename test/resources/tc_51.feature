# language: fr
Fonctionnalité: Consultation
  
  Scénario: Consultation publique
    Etant donné l'utilisateur est un administrateur
    Et l'utilisateur se connecte
    Quand l'utilisateur consulte la liste des enchères
    Alors la liste des enchères publiques est visible
    
  Scénario: Consultation privée
    Etant donné l'utilisateur est un administrateur
    Et l'utilisateur se connecte
    Quand l'utilisateur consulte la liste des enchères
    Alors la liste des enchères privées est visible
    
  Scénario: Consultation confidentielle
    Etant donné l'utilisateur est un administrateur
    Et l'utilisateur se connecte
    Quand l'utilisateur consulte la liste des enchères
    Alors la liste des enchères confidentielles est visible
