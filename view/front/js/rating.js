document.querySelectorAll('.stars i').forEach(star => {
    star.addEventListener('click', function () {
        const rating = this.getAttribute('data-value'); // Récupérer la note
        const productId = this.parentElement.getAttribute('data-product-id'); // Récupérer l'ID du produit

        // Appeler addRating.php via AJAX
        fetch('addRating.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: new URLSearchParams({ rating, product_id: productId })
        })
        .then(response => response.json())
        .then(data => {
            const messageElement = document.getElementById(`ratingMessage-${productId}`);
            if (data.success) {
                messageElement.textContent = data.message; // Afficher le message de succès
                messageElement.style.color = 'green';
            } else {
                messageElement.textContent = data.message; // Afficher le message d'erreur
                messageElement.style.color = 'red';
            }
        })
        .catch(error => {
            console.error('Erreur AJAX:', error);
            alert('Une erreur est survenue. Veuillez réessayer.');
        });
    });
});
