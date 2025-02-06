<?php

use App\Models\listeInsModels;
use App\Models\UsersModels;

    require_once "../../../vendor/autoload.php";
    session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Youdemy - Détails du cours</title>
    <link
        rel="shortcut icon"
        href="../../assets/images/logo_icone.png"
        type="image/png"
    >
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js"></script>
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
</head>

<body class="bg-gray-50">
    <?php require_once "../components/header.php"; ?>

    <!-- Contenu Principal -->
    <div class="pt-16 pb-12">
        <!-- En-tête du profil -->
        <div class="bg-white shadow-md mb-6 ">
            <div class="max-w-7xl mx-auto p-6 ">
                <div class="flex flex-col md:flex-row items-center gap-6">
                    <div class="w-32 h-32 rounded-full overflow-hidden">
                        <img src="<?= "data:image/png;base64,".$_SESSION['image']?>" alt="Photo de profil de <?= $_SESSION['username']; ?>" class="w-full h-full object-cover">
                    </div>
                    <div class="flex-1 text-center md:text-left">
                        <h1 class="text-2xl font-bold mb-2"><?= $_SESSION['username']; ?></h1>
                        <p class="text-gray-600 mb-4">Etudiant</p>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="flex items-center gap-2">
                                <i class="fas fa-map-marker-alt text-blue-500"></i>
                                <span><?= $_SESSION['ville']; ?>, Maroc</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <i class="fas fa-phone text-blue-500"></i>
                                <span><?= $_SESSION['telephone']; ?></span>
                            </div>
                            <div class="flex items-center gap-2">
                                <i class="fas fa-envelope text-blue-500"></i>
                                <span><?= $_SESSION['email']; ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Onglets -->
        <div class="max-w-7xl mx-auto px-4">
            <div class="mb-6 border-b">
                <div class="flex flex-wrap -mb-px">
                    <a href="profil.php?#">
                        <button class="inline-flex items-center h-12 px-4 py-2 text-sm font-medium leading-5 <?= (empty($_GET))? 'text-blue-500 border-bltext-blue-500 border-b-2' : 'text-gray-500 hover:text-blue-500' ?> focus:outline-none">
                            <i class="fas fa-user mr-2"></i>
                            Profile
                        </button>
                    </a>
                    <a href="?MesCours">
                        <button class="inline-flex items-center h-12 px-4 py-2 text-sm font-medium leading-5 <?= (isset($_GET['MesCours']))? 'text-blue-500 border-bltext-blue-500 border-b-2' : 'text-gray-500 hover:text-blue-500' ?> focus:outline-none">
                            <i class="fas fa-newspaper mr-2"></i>
                            Mes Cours
                        </button>
                    </a>
                </div>
            </div>

            <!-- Contenu des onglets -->
            
            <!-- Profile -->
            <?php if (empty($_GET)) { ?>
                <div id="Profile" class="tab-content">
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h2 class="text-xl font-semibold mb-4">Information Personnelle</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-gray-700 font-semibold mb-2 border-b-2 border-gray-400">Nom Complet</label>
                                <p class="text-gray-600"><?= $_SESSION['username']; ?></p>
                            </div>
                            <div>
                                <label class="block text-gray-700 font-semibold mb-2 border-b-2 border-gray-400">Email</label>
                                <p class="text-gray-600"><?= $_SESSION['email']; ?></p>
                            </div>
                            <div>
                                <label class="block text-gray-700 font-semibold mb-2 border-b-2 border-gray-400">Téléphone</label>
                                <p class="text-gray-600"><?= $_SESSION['telephone']; ?></p>
                            </div>
                            <div>
                                <label class="block text-gray-700 font-semibold mb-2 border-b-2 border-gray-400">Ville</label>
                                <p class="text-gray-600"><?= $_SESSION['ville']; ?></p>
                            </div>
                        </div>
                        <div class="mt-6">
                            <button class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-500">
                                <i class="fas fa-edit mr-2"></i>Modifier le profil
                            </button>
                        </div>
                    </div>
                </div>
            <?php } ?>

            <!-- Mes cours -->
            <?php if (isset($_GET['MesCours'])) {?>
                <div id="Articles" class="tab-content ">
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h2 class="text-xl font-semibold mb-4">Mes Cours</h2>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <?php
                                $listeMesCours = listeInsModels::ObjectsListe('email', $_SESSION['email'], 'cours', 'id_cour');
                                if ($listeMesCours) {
                                    foreach ($listeMesCours as $value) {
                                        $Enseing = UsersModels::find("id_enseign", $value->__get('id_ensei'));
                                        $imagecours = stream_get_contents($value->__get('imageCours'));
                                        $imageEnseing = stream_get_contents($Enseing->__get('image'));

                            ?>
                            
                            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                                <img src="data:image/png;base64,<?= htmlspecialchars(base64_encode($imagecours)) ?>" class="w-full h-48 object-cover">
                                <div class="p-6">
                                    <div class="flex items-center justify-between mb-4">
                                        <span class="text-sm text-gray-500">#ID: <?= htmlspecialchars($value->__get('id_cour')) ?></span>
                                        <div class="flex self-end flex-wrap gap-2">
                                            <p class="text-xs text-gray-500"><?= htmlspecialchars($value->__get('createDate'))  ?></p>
                                        </div>
                                    </div>
                                    <h3 class="text-xl font-semibold mb-2"><?= htmlspecialchars($value->__get('cours_titre')) ?></h3>
                                    <p class="text-gray-600 mb-4 line-clamp-2"><?= htmlspecialchars($value->__get('description')) ?></p>
                                    <div class="flex items-center mb-4">
                                        <img src="data:image/png;base64,<?= htmlspecialchars(base64_encode($imageEnseing)) ?>" alt="Author" class="w-8 h-8 rounded-full mr-3">
                                        <div>
                                            <p class="text-sm font-semibold">Mr.<?= htmlspecialchars($Enseing->__get('username')) ?></p>
                                            <p class="text-xs text-gray-500"><?= htmlspecialchars($Enseing->__get('email'))  ?></p>
                                        </div>
                                    </div>
                                    <div class="catalog flex items-center justify-between">
                                        <div class="text-sm text-gray-500">
                                            <i class="fas fa-folder-open mr-2"></i>
                                            <?= htmlspecialchars($value->__get('catalogue_titre'))  ?>
                                        </span>
                                        </div>
                                            <a href="./Details.php?idCours=<?= htmlspecialchars($value->__get('id_cour'))  ?>" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                                                Voir le cours
                                            </a>
                                        </div>
                                </div>
                            </div>

                            <?php }} else { ?>
                                <p class="text-gray-600">Aucun inscription des cours.</p>                                
                            <?php } ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>

    <!-- Footer -->
    <?php require_once "../components/footer.php"; ?>

    <script>
        function showTab(tabId) {
            // Cacher tous les contenus des onglets
            document.querySelectorAll('.tab-content').forEach(tab => {
                tab.classList.add('hidden');
            });
            
            // Afficher le contenu de l'onglet sélectionné
            document.getElementById(tabId).classList.remove('hidden');
            
            // Mettre à jour les styles des boutons
            document.querySelectorAll('button').forEach(button => {
                button.classList.remove('text-blue-500', 'border-b-2', 'border-bltext-blue-500');
                button.classList.add('text-gray-500');
            });
            
            // Mettre en surbrillance le bouton actif
            event.currentTarget.classList.remove('text-gray-500');
            event.currentTarget.classList.add('text-blue-500', 'border-b-2', 'border-bltext-blue-500');
        }
    </script>
</body>
</html>