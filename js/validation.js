

function validateForm() {
    // Récupération des valeurs des champs de formulaire
    var username = document.getElementById('username').value;
    var password = document.getElementById('password').value;
  
    // Initialisation des messages d'erreur
    var usernameError = document.getElementById('username-error');
    var passwordError = document.getElementById('password-error');
    
    // Vérification de la longueur du nom d'utilisateur
    if (username.length > 30 || username.length === 0) {
      usernameError.innerHTML = 'Le nom d\'utilisateur doit continir au plus 30 caractères';
      return false;
    }
    // Vérification que le nom d'utilisateur ne contient que des caractères alphanumériques
    if (!/^[a-zA-Z0-9]+$/.test(username)) {
      usernameError.innerHTML = 'Le nom d\'utilisateur ne peut contenir que des lettres majuscules, minuscules et des chiffres';
      return false;
    }

    // Vérification de la longueur du mot de passe
    if (password.length === 12) {
      passwordError.innerHTML = 'Le mot de passe doit contenir au moins 12 caractères';
      return false;
    }
  
    // Vérification de la complexité du mot de passe
    if (!/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/.test(password)) {
      passwordError.innerHTML = 'Le mot de passe doit contenir au moins une majuscule, une minuscule, un chiffre et un caractère spécial';
      return false;
    }
  
    // Suppression des messages d'erreur
    usernameError.innerHTML = '';
    passwordError.innerHTML = '';
  
    // Soumission du formulaire
    return true;
  }
  