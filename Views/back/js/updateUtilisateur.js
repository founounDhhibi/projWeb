console.log("Le fichier updateUtilisateur.js est bien chargé !");

document.addEventListener("DOMContentLoaded", function () {
  // Définir les variables et récupérer les éléments du formulaire par leur ID
  var nomUser = document.getElementById("nom_user");
  var prenomUser = document.getElementById("prenom_user");
  var emailUser = document.getElementById("email_user");
  var telUser = document.getElementById("tel_user");
  var adresseUser = document.getElementById("adresse_user");
  var username = document.getElementById("username");
  var passwordUser = document.getElementById("password_user");
  var form = document.getElementById("UserForm");

  // Validation du champ nom_user
  nomUser.addEventListener("keyup", function () {
    var nomUserError = document.getElementById("nomUserError");
    var nomUserValue = nomUser.value.trim();
    var nameRegex = /^[A-Za-z\s]+$/; // Permet uniquement les lettres et les espaces

    if (nomUserValue === "") {
      nomUserError.innerHTML = "Le nom est requis.";
      nomUserError.style.color = "red";
    } else if (!nameRegex.test(nomUserValue)) {
      nomUserError.innerHTML = "Le nom ne peut contenir que des lettres et des espaces.";
      nomUserError.style.color = "red";
    } else {
      nomUserError.innerHTML = "Correct.";
      nomUserError.style.color = "green";
    }
  });

  // Validation du champ prenom_user
  prenomUser.addEventListener("keyup", function () {
    var prenomUserError = document.getElementById("prenomUserError");
    var prenomUserValue = prenomUser.value.trim();
    var nameRegex = /^[A-Za-z\s]+$/; // Permet uniquement les lettres et les espaces

    if (prenomUserValue === "") {
      prenomUserError.innerHTML = "Le prénom est requis.";
      prenomUserError.style.color = "red";
    } else if (!nameRegex.test(prenomUserValue)) {
      prenomUserError.innerHTML = "Le prénom ne peut contenir que des lettres et des espaces.";
      prenomUserError.style.color = "red";
    } else {
      prenomUserError.innerHTML = "Correct.";
      prenomUserError.style.color = "green";
    }
  });

  // Validation du champ email_user
  emailUser.addEventListener("keyup", function () {
    var emailUserError = document.getElementById("emailUserError");
    var emailUserValue = emailUser.value.trim();
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Email valide

    if (emailUserValue === "") {
      emailUserError.innerHTML = "L'email est requis.";
      emailUserError.style.color = "red";
    } else if (!emailRegex.test(emailUserValue)) {
      emailUserError.innerHTML = "L'email n'est pas valide.";
      emailUserError.style.color = "red";
    } else {
      emailUserError.innerHTML = "Correct.";
      emailUserError.style.color = "green";
    }
  });

  // Validation du champ tel_user
  telUser.addEventListener("keyup", function () {
    var telUserError = document.getElementById("telUserError");
    var telUserValue = telUser.value.trim();
    var telRegex = /^[0-9]{8,15}$/; // Permet uniquement les chiffres

    if (telUserValue === "") {
      telUserError.innerHTML = "Le numéro de téléphone est requis.";
      telUserError.style.color = "red";
    } else if (!telRegex.test(telUserValue)) {
      telUserError.innerHTML = "Le téléphone doit contenir entre 8 et 15 chiffres.";
      telUserError.style.color = "red";
    } else {
      telUserError.innerHTML = "Correct.";
      telUserError.style.color = "green";
    }
  });

  // Validation du champ adresse_user
  adresseUser.addEventListener("keyup", function () {
    var adresseUserError = document.getElementById("adresseUserError");
    var adresseUserValue = adresseUser.value.trim();

    if (adresseUserValue === "") {
      adresseUserError.innerHTML = "L'adresse est requise.";
      adresseUserError.style.color = "red";
    } else if (adresseUserValue.length < 5) {
      adresseUserError.innerHTML = "L'adresse doit contenir au moins 5 caractères.";
      adresseUserError.style.color = "red";
    } else {
      adresseUserError.innerHTML = "Correct.";
      adresseUserError.style.color = "green";
    }
  });

  // Validation du champ username
  username.addEventListener("keyup", function () {
    var usernameError = document.getElementById("usernameError");
    var usernameValue = username.value.trim();

    if (usernameValue === "") {
      usernameError.innerHTML = "Le nom d'utilisateur est requis.";
      usernameError.style.color = "red";
    } else if (usernameValue.length < 3) {
      usernameError.innerHTML = "Le nom d'utilisateur doit contenir au moins 3 caractères.";
      usernameError.style.color = "red";
    } else {
      usernameError.innerHTML = "Correct.";
      usernameError.style.color = "green";
    }
  });

  // Validation du champ password_user
  passwordUser.addEventListener("keyup", function () {
    var passwordUserError = document.getElementById("passwordUserError");
    var passwordUserValue = passwordUser.value.trim();

    if (passwordUserValue === "") {
      passwordUserError.innerHTML = "Le mot de passe est requis.";
      passwordUserError.style.color = "red";
    } else if (passwordUserValue.length < 6) {
      passwordUserError.innerHTML = "Le mot de passe doit contenir au moins 6 caractères.";
      passwordUserError.style.color = "red";
    } else {
      passwordUserError.innerHTML = "Correct.";
      passwordUserError.style.color = "green";
    }
  });

  // Validation sur l'envoi du formulaire
  form.addEventListener("submit", function (e) {
    var errors = 0;

    // Vérification de chaque champ
    if (nomUser.value.trim() === "") {
      console.error("Le champ 'Nom' est vide.");
      errors++;
    }
    if (prenomUser.value.trim() === "") {
      console.error("Le champ 'Prénom' est vide.");
      errors++;
    }
    if (emailUser.value.trim() === "" || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(emailUser.value.trim())) {
      console.error("Le champ 'Email' est invalide.");
      errors++;
    }
    if (telUser.value.trim() === "" || !/^[0-9]{8,15}$/.test(telUser.value.trim())) {
      console.error("Le champ 'Téléphone' est invalide.");
      errors++;
    }
    if (adresseUser.value.trim() === "") {
      console.error("Le champ 'Adresse' est vide.");
      errors++;
    }
    if (username.value.trim() === "" || username.value.trim().length < 3) {
      console.error("Le champ 'Nom d'utilisateur' est invalide.");
      errors++;
    }
    if (passwordUser.value.trim() === "" || passwordUser.value.trim().length < 6) {
      console.error("Le champ 'Mot de passe' est invalide.");
      errors++;
    }

    // Empêcher l'envoi du formulaire si des erreurs sont présentes
    if (errors > 0) {
      e.preventDefault();
      alert("Veuillez remplir tous les champs correctement avant de soumettre.");
    }
  });
});
