<!-- Navigation -->
    <nav class="bg-white h-[4rem] shadow-md">
        <div class="container h-full mx-auto px-6 py-3">
            <div class="flex h-full items-center justify-between">
                <div class="flex h-full items-center">
                    <a href="<?="./homes.php"?>" class="h-full">
                        <img src="../../Public/assets/images/logo.png" alt="logo du site" class="h-full">
                    </a>
                </div>
                <div class="hidden md:flex items-center space-x-8">
                    <a href="./home.php" class="text-blue-600">Home</a>
                    <a href="./pages/Etudiant/Cours.php" class="text-gray-600 hover:text-blue-600">Cours</a>
                    <a href="./pages/Etudiant/Profil.php" class="text-gray-600 hover:text-blue-600">Profil</a>
                </div>
                <?php if (isset($_SESSION['id_user'])) {?>
                    <div class="flex items-center space-x-4">
                        <a href="./pages/Etudiant/profil.php">
                            <button class="flex items-center text-gray-700 hover:text-blue-600">
                                <img src="data:image/png;base64,<?= htmlspecialchars($_SESSION['image'])?>" alt="Etudiant" class="w-8 h-8 rounded-full mr-2">
                                <span><?= htmlspecialchars($_SESSION['username'])?></span>
                            </button>
                        </a>
                        <a href="./pages/Authentification/proccessors/desconnecte.php?déconnexion=<?= htmlspecialchars($_SESSION['id_user'])?>" class="text-red-500 px-4 py-2 rounded-lg hover:bg-red-100">
                            <i class="fas fa-sign-out-alt"></i>
                        </a>
                    </div>
                <?php } else { ?>
                    <div class="flex items-center space-x-4">
                        <a href="./Authentification/connexion.php" class="text-gray-600 hover:text-blue-600">Se connecter</a>
                        <a href="./Authentification/inscription.php" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">S'inscrire</a>
                    </div>
                <?php } ?>
            </div>
        </div>
    </nav>