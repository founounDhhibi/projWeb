console.log("Le fichier ajouterCategorie.js est bien chargé !");

document.addEventListener("DOMContentLoaded", function () {
  // Définir les variables et récupérer les éléments du formulaire par leur ID
  var categoryName = document.getElementById("categoryName");
  var categoryDescription = document.getElementById("categoryDescription");
  var form = document.getElementById("CategoryForm");

  // Validation du champ categoryName
  categoryName.addEventListener("keyup", function () {
    var categoryNameError = document.getElementById("categoryNameError");
    var categoryNameValue = categoryName.value.trim();
    var nameRegex = /^[A-Za-z\s]+$/; // Permet uniquement les lettres et les espaces

    if (categoryNameValue === "") {
      categoryNameError.innerHTML = "Le nom de la catégorie est requis.";
      categoryNameError.style.color = "red";
    } else if (!nameRegex.test(categoryNameValue)) {
      categoryNameError.innerHTML = "Le nom de la catégorie ne peut contenir que des lettres et des espaces.";
      categoryNameError.style.color = "red";
    } else {
      categoryNameError.innerHTML = "Correct.";
      categoryNameError.style.color = "green";
    }
  });

  // Validation du champ categoryDescription
  categoryDescription.addEventListener("keyup", function () {
    var categoryDescriptionError = document.getElementById("categoryDescriptionError");
    var categoryDescriptionValue = categoryDescription.value.trim();

    if (categoryDescriptionValue === "") {
      categoryDescriptionError.innerHTML = "La description de la catégorie est requise.";
      categoryDescriptionError.style.color = "red";
    } else if (categoryDescriptionValue.length < 10) {
      categoryDescriptionError.innerHTML = "La description doit contenir au moins 10 caractères.";
      categoryDescriptionError.style.color = "red";
    } else {
      categoryDescriptionError.innerHTML = "Correct.";
      categoryDescriptionError.style.color = "green";
    }
  });

  // Validation sur l'envoi du formulaire
  form.addEventListener("submit", function (e) {
    var errors = 0;

    // Vérifier si 'categoryName' est vide ou invalide
    if (categoryName.value.trim() === "") {
      console.error("Le champ 'Nom de la catégorie' est vide.");
      errors++;
    }

    // Vérifier si 'categoryDescription' est vide ou trop courte
    if (categoryDescription.value.trim() === "") {
      console.error("Le champ 'Description de la catégorie' est vide.");
      errors++;
    } else if (categoryDescription.value.trim().length < 10) {
      console.error("La description doit contenir au moins 10 caractères.");
      errors++;
    }

    // Annuler l'envoi si des champs sont vides ou invalides
    if (errors > 0) {
      e.preventDefault();  // Empêche l'envoi du formulaire
      alert("Veuillez remplir tous les champs correctement avant de soumettre.");
    }
  });
});
