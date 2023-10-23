/* Ici on utilise l'API Chart JS avec des données de la base de donnée ainsi on peut dirèctement
   modifier les données affichés depuis l'administration ou le backoffice. Les éléments liés à la 
   base de donnée sont (labels, data, backgroundColor, borderColor, et color) ils prennent en charge
   des tableaux et donc les tableaux qui vont y être assignés sont ceux précédement créer dans "cv.php"
   (nom_formation, niveau, couleur_arriere_plan, couleur_bordure et couleur_text). */

  // Enregistrement des données à afficher dans la variable "data".
  const data = {
  labels: nom_formation,
  datasets: [{
    label: '',
    data: niveau,
    backgroundColor: couleur_arriere_plan,
    borderColor: couleur_bordure,
    borderWidth: 1,
    borderRadius: 20,
    borderSkipped: false,
  }]
};

  // Configuration du graphique dans la variable "config".
  const config = {
  type: 'bar',
  data,
  options: {
    indexAxis: 'y',
    scales: {
      y: {
        beginAtZero: true,
        ticks: {
                    color: ['white']
                }
      }
    },
    plugins: {
    legend: {
            display: false
    },
    tooltip: {
        enabled: false
    },
    datalabels: {
        color: couleur_text,
        formatter: (value) => {
            return value + " %";
        }
    }
  },
  maintainAspectRatio: false
},
  // On utilise l'extension ChartDataLabels qui permet d'écrire sur les labels.
  plugins: [ChartDataLabels]
};

  // On crée un nouveau graphique en prenant en paramètre la configuration "config".
  const myChart = new Chart(
  document.getElementById('myChart'),
  config
);