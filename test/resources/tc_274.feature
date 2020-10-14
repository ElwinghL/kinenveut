# language: fr
Fonctionnalité: Consultation des messages
  
  Scénario: Vue normale
    Etant donné L'utilisateur est connecté.
    Et l'utilisateur a reçu au moins un message
    Quand l'utilisateur consulte la messagerie
    Alors les messages sont affichés
    
  Scénario: Non-accès autre
    Etant donné L'utilisateur est connecté.
    Et l'utilisateur n'a reçu aucun message
    Et un autre utilisateur a reçu un message
    Quand l'utilisateur consulte la messagerie
    Alors aucun message n'est affiché