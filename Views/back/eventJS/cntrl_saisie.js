let myForm = document.getElementById('eventForm');
if (myForm) {
    myForm.addEventListener('submit', function (e) {
        // Initialisation des erreurs
        let hasError = false;

        // Validation du nom
        let nom = document.getElementById('event_nom');
        let nomError = document.getElementById('nomError');
        if (nom.value.trim() === '') {
            nomError.innerHTML = "Le champ nom est requis.";
            hasError = true;
        } else {
            nomError.innerHTML = '';
        }

        // Validation du nombre de places
        let nbrPlace = document.getElementById('event_nbr_place');
        let nbrpError = document.getElementById('nbrpError');
        if (nbrPlace.value <= 0 || nbrPlace.value === '') {
            nbrpError.innerHTML = "Le champ nombre de places doit être supérieur à 0.";
            hasError = true;
        } else {
            nbrpError.innerHTML = '';
        }

        // Validation de l'image
        let image = document.getElementById('event_image');
        let imageError = document.getElementById('imageError');
        if (image.files.length === 0) {
            imageError.innerHTML = "L'image est requise.";
            hasError = true;
        } else if (!image.files[0].type.startsWith('image/')) {
            imageError.innerHTML = "Le fichier doit être de type image.";
            hasError = true;
        } else {
            imageError.innerHTML = '';
        }

        // Validation de la description
        let description = document.getElementById('event_desc');
        let descriptionError = document.getElementById('descriptionError');
        if (description.value.trim().length < 20) {
            descriptionError.innerHTML = "La description doit contenir au moins 20 caractères.";
            hasError = true;
        } else {
            descriptionError.innerHTML = '';
        }

        // Validation de la date
        let eventDate = document.getElementById('event_date');
        let dateError = document.getElementById('dateError');
        let today = new Date();
        let selectedDate = new Date(eventDate.value);
        if (eventDate.value === '' || selectedDate <= today) {
            dateError.innerHTML = "La date doit être une date future.";
            hasError = true;
        } else {
            dateError.innerHTML = '';
        }

        // Empêcher l'envoi si une erreur est détectée
        if (hasError) {
            e.preventDefault();
        }
    });
}

let myFormEdit = document.getElementById('eventEditForm');
if (myFormEdit) {
    myFormEdit.addEventListener('submit', function (e) {
        // Initialisation des erreurs
        let hasError = false;

        // Validation du nom
        let nom = document.getElementById('event_nom');
        let nomError = document.getElementById('nomError');
        if (nom.value.trim() === '') {
            nomError.innerHTML = "Le champ nom est requis.";
            hasError = true;
        } else {
            nomError.innerHTML = '';
        }

        // Validation du nombre de places
        let nbrPlace = document.getElementById('event_nbr_place');
        let nbrpError = document.getElementById('nbrpError');
        if (nbrPlace.value <= 0 || nbrPlace.value === '') {
            nbrpError.innerHTML = "Le champ nombre de places doit être supérieur à 0.";
            hasError = true;
        } else {
            nbrpError.innerHTML = '';
        }

        // Validation de l'image
        let image = document.getElementById('event_image');
        let imageError = document.getElementById('imageError');

        if (image.files.length > 0) {
            if (!image.files[0].type.startsWith('image/')) {
                imageError.innerHTML = "Le fichier doit être de type image.";
                hasError = true;
            } else {
                imageError.innerHTML = '';
            }
        } else {
            imageError.innerHTML = '';
        }


        // Validation de la description
        let description = document.getElementById('event_desc');
        let descriptionError = document.getElementById('descriptionError');
        if (description.value.trim().length < 20) {
            descriptionError.innerHTML = "La description doit contenir au moins 20 caractères.";
            hasError = true;
        } else {
            descriptionError.innerHTML = '';
        }

        // Validation de la date
        let eventDate = document.getElementById('event_date');
        let dateError = document.getElementById('dateError');
        let today = new Date();
        let selectedDate = new Date(eventDate.value);
        if (eventDate.value === '' || selectedDate <= today) {
            dateError.innerHTML = "La date doit être une date future.";
            hasError = true;
        } else {
            dateError.innerHTML = '';
        }

        // Empêcher l'envoi si une erreur est détectée
        if (hasError) {
            e.preventDefault();
        }
    });
}