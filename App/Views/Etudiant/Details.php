<?php

require_once "../../../vendor/autoload.php";
use App\Models\listecoursModels;
use App\Models\listeInsModels;
    
    session_start();

    if (isset($_GET['idCours'])) {
        $idCours = $_GET['idCours'];
        $listeCour = listecoursModels::ObjectsListe('id_cour', $idCours);
        $courses = $listeCour[0];
        $listeInscription = listeInsModels::find('id_user', $_SESSION['id_user'], 'id_cour', $idCours);
    }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Youdemy - Détails du cours</title>
    <link
        rel="shortcut icon"
        href="../../../Public/assets/images/logo_icone.png"
        type="image/png"
    >
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js"></script>
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white h-[4rem] shadow-md">
        <div class="container h-full mx-auto px-6 py-3">
            <div class="flex h-full items-center justify-between">
                <div class="flex h-full items-center">
                    <a href="../../index.php" class="text-2xl h-full font-bold text-blue-600">
                        <img src="../../assets/images/logo.png" alt="logo du site" class="h-full">
                    </a>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="./Cours.php" class="text-gray-600 hover:text-blue-600">
                        <i class="fas fa-arrow-left mr-2"></i>Retour aux cours
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Course Header -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-12">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row gap-8">
                <div class="md:w-2/3">
                    <div class="flex gap-2 mb-4">
                    <?php
                        foreach ($listeCour as $value) {
                    ?>
                            <span class="bg-blue-100 bg-opacity-25 text-white px-3 py-1 rounded-full text-sm"><?= htmlspecialchars($value->__get('tag_titre')) ?></span>
                    <?php } ?>
                    </div>

                    <h1 class="text-4xl font-bold mb-4"><?= htmlspecialchars($courses->__get('cours_titre')) ?></h1>
                    <p class="text-xl mb-6"><?= htmlspecialchars($courses->__get('description')) ?></p>
                    <div class="flex items-center mb-4">
                        <img src="data:image/png;base64,<?= htmlspecialchars(base64_encode($courses->__get('userimage'))) ?>" alt="Author" class="w-12 h-12 rounded-full mr-4">
                        <div>
                            <p class="font-semibold"><?= htmlspecialchars($courses->__get('username')) ?></p>
                            <p class="text-sm"><?= htmlspecialchars($courses->__get('useremail')) ?></p>
                        </div>
                    </div>
                </div>
                <div class="md:w-1/3 bg-opacity-10 rounded-lg p-6">
                    <div class="text-center mb-6">
                        <p class="text-lg mb-2">ID du cours: #<?= htmlspecialchars($courses->__get('id_cour')) ?></p>
                        <p class="text-sm">Créé le : </p>
                        <p class="text-sm"><?= htmlspecialchars($courses->__get('createDate')) ?></p>
                    </div>
                    <div class="flex flex-col gap-4">
                        <?php if (!$listeInscription) { ?>
                            <a href="./proccessors/inscriptionCour.php?inscrit=<?= $_GET['idCours'] ?>">
                                <button class="w-full bg-white text-blue-600 px-6 py-3 rounded-lg font-semibold hover:bg-gray-100">
                                    Commencer le cours
                                </button>
                            </a>
                        <?php } else { ?>
                            <div class="flex justify-center bg-white text-blue-600 px-6 py-3 rounded-lg font-semibold">
                                <p class="text-sm">Inscrit en : <?= htmlspecialchars($listeInscription->__get('date_inscret')) ?></p>
                            </div>
                            <a href="./proccessors/inscriptionCour.php?désinscrit=<?= $_GET['idCours'] ?>">
                                <button class="w-full border border-white px-6 py-3 rounded-lg font-semibold hover:bg-white hover:text-red-500">
                                    Désinscription d'un cours
                                </button>
                            </a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Course Content -->
    <div class="container mx-auto px-6 py-12">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="md:col-span-2">
                <!-- About Section -->
                <div class="bg-whiterounded-lg shadow-md p-6 mb-8">
                    <h2 class="text-2xl font-bold mb-4">À propos de ce cours</h2>
                    <div class="flex justify-center">
                        <!-- contenu de cours -->
                        <?php if ($courses->__get('type') == 'video') { $video = stream_get_contents($courses->__get('cours_video'))?>
                            <iframe width="600" height="350" src="<?= $video ?>" 
                                        frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                        allowfullscreen>
                                </iframe>
                        <?php } else if ($courses->__get('type') == 'document') { ?>
                            <iframe 
                                    src="../../Controllers/API/document.php?id=<?= $courses->__get('id_cour') ?>" 
                                    style="width: 100%; height: 800px;" 
                                    frameborder="0"
                                    allowfullscreen>
                                </iframe>
                        <?php } ?>
                    </div>
                </div>

                <!-- Course Content Section -->
                <div class="bg-white rounded-lg shadow-md p-6 mb-8">
                    <h2 class="text-2xl font-bold mb-6">Informations des Inscriptions</h2>
                    <table class="min-w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Étudiant
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Date d'Inscription
                                </th>
                            </tr>
                        </thead>
                        <tbody id="EtudiantRow" class="bg-white divide-y divide-gray-200">
                            <!-- Student Rows -->
                            <?php
                                $listeInscription = listeInsModels::ObjectsListe('id_cour', $idCours);
                                if ($listeInscription) {
                                    foreach ($listeInscription as $value) {
                                        $imageuser =  stream_get_contents($value->__get('image'));
                            ?>
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <img src="data:image/png;base64, <?= htmlspecialchars(base64_encode($imageuser)) ?>" alt="Student" class="w-10 h-10 rounded-full mr-3">
                                                    <div>
                                                        <div class="text-sm font-medium text-gray-900"><?= htmlspecialchars($value->__get('username')) ?></div>
                                                        <div class="text-sm text-gray-500"><?= htmlspecialchars($value->__get('email')) ?></div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="text-sm text-gray-900"><?= htmlspecialchars($value->__get('date_inscret')) ?></div>
                                            </td>
                                        </tr>
                            <?php } } ?>
                        </tbody>
                    </table>
                </div>

                <!-- Requirements Section -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-2xl font-bold mb-4">Prérequis</h2>
                    <ul class="list-disc list-inside text-gray-600 space-y-2">
                        <li>Aucune expérience en programmation requise</li>
                        <li>Un ordinateur avec accès à internet</li>
                        <li>Un éditeur de texte basique</li>
                    </ul>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="md:col-span-1">
                <!-- Category Info -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-xl font-bold mb-4">Catégorie</h3>
                    <div class="flex items-center text-gray-600 mb-5">
                        <i class="fas fa-folder-open mr-2"></i>
                        <span class="text-lg"><?= htmlspecialchars($courses->__get('catalogue_titre')) ?></span>
                    </div>
                    <span><?= htmlspecialchars($courses->__get('catalogue_contenu')) ?></span>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-8">
        <div class="container mx-auto px-6 text-center">
            <p>&copy; 2025 Youdemy. Tous droits réservés.</p>
        </div>
    </footer>
</body>
</html>