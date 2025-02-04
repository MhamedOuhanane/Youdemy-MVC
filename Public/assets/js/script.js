
inputPagines = document.querySelectorAll('#conPagination input[type="radio"]');
let NBpage = 1;


// inistialiser le style des input de pagination
function styleInit(){
    document.querySelector('#conPagination .bg-blue-600').classList.add('hover:bg-gray-100');
    document.querySelector('#conPagination .bg-blue-600').classList.remove('bg-blue-600', 'text-white');
}

// continaire de pagination 
inputPagines.forEach(element => {
    element.addEventListener('change', () => {
        styleInit();
        const label = document.querySelector(`label[for="${element.id}"]`);
        label.classList.remove('hover:bg-gray-100');
        label.classList.add('bg-blue-600', 'text-white');
        NBpage = element.value;
        FetchCatalogue();
    })
});

function FetchCatalogue(){
    const url = `./pages/Etudiant/proccessors/fetchCata.php?NBpage=${NBpage}`;
    fetch(url)
    .then(response => response.json())
    .then(data =>{
        toSring(data);
    })
    .catch(error =>{
        continaireCatalogues.innerHTML = `<div class="col-span-full text-center text-red-500">
                                        <span>ERREUR : ${error.message}</span>
                                    </div>`;
    });
}

function toSring(Catalog) {
    if (Catalog == null) {
        continaireCatalogues.innerHTML = `<div class="col-span-full text-center text-red-500">
                                            <span>Aucune catégorie disponible</span>
                                        </div>`;
        return;
    } 
    continaireCatalogues.innerHTML = ``;
    
    Catalog.forEach(element => {
        continaireCatalogues.innerHTML += `<div class="bg-white rounded-lg shadow-md overflow-hidden">
                                            <img src="data:image/png;base64,${element['catalogue_image']}" alt="Catalogue ${element['id_catalogue']}" class="w-full h-60 object-cover">
                                            <div class="p-6">
                                                <span class="text-sm text-gray-500 mb-2 block">Catalogue #${element['id_catalogue']}</span>
                                                <h3 class="text-xl font-semibold mb-2">${element['catalogue_titre']}</h3>
                                                <p class="text-gray-600 mb-4">${element['catalogue_contenu']}</p>
                                                <div class="flex items-center justify-between">
                                                    <span class="text-blue-600 font-semibold">${element['coursCount']} cours</span>
                                                    <a href="./pages/Etudiant/Cours.php?idCatalogue=${element['id_catalogue']}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Voir le catalogue</a>
                                                </div>
                                            </div>
                                        </div>`;
    });

}

document.addEventListener('DOMContentLoaded', FetchCatalogue);