function supprimer_competence() {
    if (confirm("Supprimer cet compétence ?") == true) {
      return true;
  }
  else{
    return false;
  }
}