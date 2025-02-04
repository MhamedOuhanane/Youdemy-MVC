<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Youdemy - Plateforme d'apprentissage en ligne</title>
    <link
        rel="shortcut icon"
        href="./assets/images/logo_icone.png"
        type="image/png"
    >
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js"></script>
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-50">
    <?php require_once "../App/Views/components/header.php" ?>
    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white">
        <div class="container mx-auto px-6 py-20">
            <div class="flex flex-col md:flex-row items-center justify-between">
                <div class="md:w-1/2 mb-8 md:mb-0">
                    <h1 class="text-4xl md:text-5xl font-bold mb-6">Développez vos compétences avec Youdemy</h1>
                    <p class="text-xl mb-8">Accédez à des milliers de cours en ligne dispensés par des experts.</p>
                    <div class="flex space-x-4">
                        <a href="./pages/Etudiant/Cours.php" class="bg-white text-blue-600 px-6 py-3 rounded-lg font-semibold hover:bg-gray-100">Commencer</a>
                    </div>
                </div>
                <div class="md:w-1/2 h-full">
                    <img src="./assets/images/logo_image.webp" alt="Learning" class="rounded-lg h-full object-cover shadow-xl">
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="py-16 bg-white">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center mb-12">Pourquoi choisir Youdemy ?</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="p-6 bg-gray-50 rounded-lg">
                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mb-4">
                        <i class="fas fa-laptop-code text-blue-600 text-xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Cours de qualité</h3>
                    <p class="text-gray-600">Accédez à des cours créés par des experts reconnus dans leur domaine.</p>
                </div>
                <div class="p-6 bg-gray-50 rounded-lg">
                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mb-4">
                        <i class="fas fa-clock text-blue-600 text-xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Apprentissage flexible</h3>
                    <p class="text-gray-600">Apprenez à votre rythme, où que vous soyez et quand vous voulez.</p>
                </div>
                <div class="p-6 bg-gray-50 rounded-lg">
                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mb-4">
                        <i class="fas fa-certificate text-blue-600 text-xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Certificats reconnus</h3>
                    <p class="text-gray-600">Obtenez des certificats pour valoriser vos nouvelles compétences.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Popular Courses section becomes Catalogue Section -->
    <div class="py-16 bg-gray-50">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center mb-12">Catalogue des cours</h2>

            <!-- Catalogue Grid -->
            <div id="continaireCatalogues" class="grid grid-cols-1 md:grid-cols-3 min-h-64 gap-8 mb-8">
                <!-- Affichage des Catalogues disponible  -->
            </div>

            <!-- Pagination -->
            <div id="conPagination" class="flex justify-center items-center space-x-2">
                <?php 
                    // $catalogue = new Catalogues();
                    // $catalogue->pagination(3);
                ?>
            </div>
        </div>
    </div>
    <!-- Call to Action -->
    <div class="bg-blue-600 text-white py-16">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-3xl font-bold mb-4">Prêt à commencer votre apprentissage ?</h2>
            <p class="text-xl mb-8">Rejoignez des milliers d'apprenants qui ont déjà transformé leur vie avec Youdemy</p>
            <a href="./pages/Authentification/inscription.php" class="bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100">S'inscrire gratuitement</a>
        </div>
    </div>
    <?php require_once "../App/Views/components/footer.php" ?>

    <script src="./assets/js/script.js"></script>
</body>
</html>