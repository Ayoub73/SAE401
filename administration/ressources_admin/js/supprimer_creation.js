function supprimer_creation() {
    if (confirm("Supprimer cette création ?") == true) {
      return true;
  }
  else{
    return false;
  }
}