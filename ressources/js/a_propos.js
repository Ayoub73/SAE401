/* Ici on utilise l'API Leaflet avec des données de la base de donnée ainsi on peut dirèctement
   modifier les données affichés depuis l'administration ou le backoffice. Les éléments liés à la 
   base de donnée sont (latitude, longitude, marqueur_icone, marqueur_ombre, titre_survol, titre, 
   image, image_alt, adresse, site_web, telephone) ils prennent en charge des variables et donc 
   les variables qui vont y être assignés sont ceux précédement créer dans "a-propos.php"
   ($latitude, $longitude, $marqueur_icone, $marqueur_ombre, $titre_survol, $titre, 
   $image, $image_alt, $adresse, $site_web, $telephone). */


// Configuration de la carte.
const mapOptions = {


       // Niveau de zoom minimum sur la carte.
       minZoom: 9,
       
       // Position sur carte.
       center:[latitude, longitude],

       // Niveau de zoom initial.
       zoom:13
   }


// On crée une carte "map" en mettant en paramètre la configuration.   
const map = new L.map('map' , mapOptions);

            // On déploie une carte en mettant en paramètre la carte "map"
            // crée précédement. On précise aussi le lien de son image tout en créditant OpenStreetMap.
            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);


        // Configurations pour un marqueur personnalisé dans la variable "cyu_marqueur".
        let cyu_marqueur = L.icon({
            iconUrl: "ressources/medias/" + marqueur_icone, // Lien du marqueur.
            shadowUrl: "ressources/medias/" + marqueur_ombre, // Lien de l'ombre du marqueur.

            iconSize:     [38, 65], // Taille du marqueur.
            shadowSize:   [59.5, 64], // Taille de l'ombre du marqueur.
            iconAnchor:   [22, 94], // Emplacement du marqueur.
            popupAnchor:  [-3, -76] // Emplacement d'où la fenêtre contextuelle doit s’ouvrir par rapport à l’iconAnchor.
        });

        
        // On crée un marqueur personnalisé en mettant en paramètre la variable "cyu_marqueur".
        // Ce marqueur affichera le "titre" au survol et clique affichera le ("titre", "image", "image_alt",
        // "adresse", "site_web" et le "telephone").
        let marker = new L.Marker([latitude, longitude], {icon: cyu_marqueur});
            marker.bindPopup().openPopup();
  
            // Booléen pour vérfifier si on clique sur le marqueur.
            let isClicked = false
  
            // Affiche le "titre" quand la souris et sur le marqueur et s'il n'y a pas de clique.  
            marker.on({
            mouseover: function() {
            if(!isClicked) {
            this.bindPopup(titre_survol).openPopup()
          }
          },
            // Ferme l'affichage quand la souris n'est pas sur le marqueur et s'il n'y a pas de clique.
            mouseout: function() { 
            if(!isClicked) {
              this.closePopup()
          }
      },
          // Affiche le ("titre", "image", "image_alt", "adresse", "site_web" et le "telephone"),
          // s'il y a un clique et le maintient ouvert jusqu'au clique sur une zone de la carte
          // hors de la fenêtre d'affichage ou sur le bouton de fermeture. 
          click: function() {
          isClicked = true
          marker.bindPopup("<h4 id=titre_iut>" + titre + "</h4>" + "<br>" + 
          "<div id=conteneurImage><img id=image_iut src= ressources/medias/" + image + " alt= " + image_alt + "/></div>" + 
          "<br>" + "<p>Adresse : " + adresse + "</p>" +
          "<p>Site Web : <a href= " + site_web + ">" + site_web + "</a></p>" + 
          "<p>Téléphone IUT : " + telephone + "</p>").openPopup()          
      }
  })
          // Ferme la fenêtre d'affichage si un autre endroit de la carte est cliqué.   
          map.on ({
          click: function() {
          isClicked = false
      },
          // Ferme la fenêtre d'affichage si le bouton fermeture est cliqué.
          popupclose: function () {
          isClicked = false
      }
  })
            // On ajoute le marqueur à la carte.
            marker.addTo(map);