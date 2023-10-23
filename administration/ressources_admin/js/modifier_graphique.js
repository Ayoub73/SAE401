/* Fonction "fermerNotification" qui consiste à 
   fermer la notification après l'envoi d'un formulaire. */

function fermerNotification() {
    const notification = document.getElementById("containNotif"); 
    notification.remove();
  }

/*  Usage de setTimout qui consiste à fermer automatiquement 
    une notification après l'envoi d'un formulaire. */

  setTimeout(function(){
    const notification = document.getElementById('containNotif');
    notification.remove();
  }, 5000);