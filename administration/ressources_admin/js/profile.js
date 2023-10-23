 // Pour personalisé la valeur du champ upload pdf.

 function fichier_par_defaut(id, nom_fichier) {
 
 const fileInput = document.querySelector(id);
    
 const myFile = new File([''], nom_fichier, {
     type: 'text/plain',
     lastModified: new Date(),
 });

 const dataTransfer = new DataTransfer();
 dataTransfer.items.add(myFile);
 fileInput.files = dataTransfer.files;

    }

    fichier_par_defaut("#lien_pdf", lien_pdf);