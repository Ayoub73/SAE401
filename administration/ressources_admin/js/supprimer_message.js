function supprimer_message() {
    if (confirm("Supprimer ce message ?") == true) {
      return true;
  }
  else{
    return false;
  }
}