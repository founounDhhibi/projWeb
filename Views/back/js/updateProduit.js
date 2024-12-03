console.log("Le fichier updateProduit.js est bien chargé !");

document.addEventListener("DOMContentLoaded", function () {
  // Définir les variables et récupérer les éléments du formulaire par leur ID
  var nom_prod = document.getElementById("productName");
  var description_prod = document.getElementById("productDescription");
  var prix_prod = document.getElementById("productPrice");
  var stock_prod = document.getElementById("productStock");
  var date_prod = document.getElementById("productDate");
  var form = document.getElementById("ProductForm");


  // Validation du champ productName
  nom_prod.addEventListener("keyup", function () {
    var nomProdError = document.getElementById("productNameError");
    var nomProdValue = nom_prod.value.trim();
    var nameRegex = /^[^\d]{8,}$/; // Minimum 8 caractères, pas de chiffres

    if (!nameRegex.test(nomProdValue)) {
      nomProdError.innerHTML = "Le nom doit contenir au moins 8 caractères sans chiffres.";
      nomProdError.style.color = "red";
    } else {
      nomProdError.innerHTML = "Correct.";
      nomProdError.style.color = "green";
    }
  });

  // Validation du champ productDescription
  description_prod.addEventListener("keyup", function () {
    var descriptionError = document.getElementById("productDescriptionError");
    var descriptionValue = description_prod.value.trim();

    if (descriptionValue.length < 8) {
      descriptionError.innerHTML = "La description doit contenir au moins 8 caractères.";
      descriptionError.style.color = "red";
    } else {
      descriptionError.innerHTML = "Correct.";
      descriptionError.style.color = "green";
    }
  });

  // Validation du champ productPrice
  prix_prod.addEventListener("keyup", function () {
    var prixError = document.getElementById("productPriceError");
    var prixValue = prix_prod.value.trim();

    if (isNaN(prixValue) || parseFloat(prixValue) <= 0) {
      prixError.innerHTML = "Le prix doit être un nombre valide supérieur à 0.";
      prixError.style.color = "red";
    } else {
      prixError.innerHTML = "Correct.";
      prixError.style.color = "green";
    }
  });

  // Validation du champ productStock
  if (stock_prod) {
    stock_prod.addEventListener("keyup", function () {
      var stockError = document.getElementById("productStockError");
      var stockValue = stock_prod.value.trim();

      if (isNaN(stockValue) || parseInt(stockValue) <= 0) {
        stockError.innerHTML = "Le stock doit être un nombre valide supérieur à 0.";
        stockError.style.color = "red";
      } else {
        stockError.innerHTML = "Correct.";
        stockError.style.color = "green";
      }
    });
  } else {
    console.error("L'élément productStock n'a pas été trouvé.");
  }

  // Validation du champ productDate
 
date_prod.addEventListener("input", function () {
    var dateError = document.getElementById("productDateError");
    var dateValue = date_prod.value.trim();
  
    if (dateValue === "") {
      dateError.innerHTML = "Ce champ est requis.";
      dateError.style.color = "red";
      return;  // Si la date est vide, sortir de la fonction
    }
  
    // Créer un objet Date à partir de la valeur saisie
    var selectedDate = new Date(dateValue);
    var today = new Date();
    today.setHours(0, 0, 0, 0); // Supprime les heures de la date actuelle pour la comparaison
  
    // Vérifier si la date est valide
    if (isNaN(selectedDate.getTime())) {
      dateError.innerHTML = "Format de date invalide. Utilisez le format AAAA-MM-JJ.";
      dateError.style.color = "red";
    }
    // Vérifier si la date est inférieure à aujourd'hui
    else if (selectedDate < today) {
      dateError.innerHTML = "La date doit être aujourd'hui ou dans le futur.";
      dateError.style.color = "red";
    } else {
      dateError.innerHTML = "Correct.";
      dateError.style.color = "green";
    }
  });
  

  // Validation sur l'envoi du formulaire
  form.addEventListener("submit", function (e) {
    var errors = 0;

    // Vérifier si chaque champ est rempli
    if (nom_prod.value.trim() === "") {
      console.error("Le champ 'Nom du produit' est vide.");
      errors++;
    }

    if (description_prod.value.trim() === "") {
      console.error("Le champ 'Description du produit' est vide.");
      errors++;
    }

    if (prix_prod.value.trim() === "") {
      console.error("Le champ 'Prix du produit' est vide.");
      errors++;
    }

    if (stock_prod.value.trim() === "") {
      console.error("Le champ 'Stock du produit' est vide.");
      errors++;
    }

    if (date_prod.value.trim() === "") {
      console.error("Le champ 'Date du produit' est vide.");
      errors++;
    }

    // Annuler l'envoi si des champs sont vides
    if (errors > 0) {
      e.preventDefault();
      alert("Veuillez remplir tous les champs avant de soumettre le formulaire.");
    }
  });
});
