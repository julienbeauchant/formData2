fetch('http/get.php')
.then(response => response.json())
.then(data => {
    console.log(data);
})

const form = document.getElementById('myForm');
form.addEventListener('submit', function(event) {
    event.preventDefault(); // Empêcher la soumission du formulaire par défaut

    // Récupérer les données du formulaire
    const formData = new FormData(form);
    // Effectuer la requête Fetch
    fetch('http/post.php', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Erreur lors de la requête.');
        }
        if (response.ok){
            console.log('data ajoutée avec succès');
        }
    })
    .catch(error => {
        console.error('Erreur:', error);
    });
});
