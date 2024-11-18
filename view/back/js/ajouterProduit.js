document.getElementById('productForm').addEventListener('submit', function (event) {
  event.preventDefault(); // Empêche la soumission par défaut

  // Récupérer les valeurs des champs
  const productName = document.getElementById('productName').value.trim();
  const productPieces = document.getElementById('productPieces').value.trim();
  const productDate = document.getElementById('productDate').value.trim();
  const productDescription = document.getElementById('productDescription').value.trim();
  const productStatus = document.querySelector('input[name="productStatus"]:checked');
  const productCategory = document.getElementById('productCategory').value;
  const productPrice = document.getElementById('productPrice').value.trim();
  const productImage = document.getElementById('productImage').files[0];

  // Vérifications de chaque champ

  // Vérifier le nom du produit (chaine de caractère, au moins 8 caractères, sans chiffres)
  const nameRegex = /^[^\d]{4,}$/; // Au moins 8 caractères sans chiffres
  if (!productName || !nameRegex.test(productName)) {
      alert('The product name must be at least 8 characters long and should not contain numbers.');
      return;
  }

  // Vérifier la description du produit (chaine de caractère, au moins 8 caractères)
  if (!productDescription || productDescription.length < 4) {
      alert('The product description must be at least 8 characters long.');
      return;
  }

  // Vérifier le nombre de pièces (int positif)
  if (!productPieces || isNaN(productPieces) || parseInt(productPieces) <= 0) {
      alert('Please enter a valid number of pieces.');
      return;
  }

  // Vérifier la date du produit (doit être dans le futur ou actuelle)
  const today = new Date();
  const selectedDate = new Date(productDate);
  if (!productDate || selectedDate < today.setHours(0, 0, 0, 0)) {
      alert('The product date must be today or a future date.');
      return;
  }

  // Vérifier le statut du produit (enum)
  if (!productStatus) {
      alert('Please select the product status.');
      return;
  }

  // Vérifier la catégorie du produit (ID valide sélectionné)
  if (!productCategory) {
      alert('Please select a product category.');
      return;
  }

  // Vérifier le prix du produit (decimal positif)
  if (!productPrice || isNaN(productPrice) || parseFloat(productPrice) <= 0) {
      alert('Please enter a valid product price.');
      return;
  }

  // Vérifier l'image du produit (fichier obligatoire)
  if (!productImage) {
      alert('Please upload a product image.');
      return;
  }

  // Préparer les données à envoyer
  const formData = new FormData();
  formData.append('nom_prod', productName);
  formData.append('stock_prod', productPieces);
  formData.append('date_prod', productDate);
  formData.append('description_prod', productDescription);
  formData.append('Status_prod', productStatus.value); // Envoi de l'option sélectionnée
  formData.append('categorie_prod', productCategory); // Envoi de l'ID de la catégorie sélectionnée
  formData.append('prix_prod', productPrice);
  formData.append('image_prod', productImage);

  

 /*
  fetch('', {
    method: 'POST',
    body :formData
  })
    .then(response => response.json())
    .then(data => {
      if (data.status === 'success') {
        alert('Product added successfully!');
        document.getElementById('productForm').reset();
      } else {
        alert('Error: ' + data.message);
      }
    })
    .catch(error => {
      console.error('Error:', error);
      alert('An error occurred while adding the product.');
    });*/
});
