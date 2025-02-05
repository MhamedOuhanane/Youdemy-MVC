<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Youdemy - Inscription</title>
    <link
        rel="shortcut icon"
        href="../../assets/images/logo_icone.png"
        type="image/png"
    >
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js"></script>    
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>

</head>
<body class="bg-gray-50">

    <!-- Afficher les messages et les erreur d'insertion -->
    <?php
        if (isset($_GET)) {
            if (isset($_GET['erreur'])) {
                echo '
                        <div id="SwitAlair" class="absolute w-[28rem] right-[-28rem] p-5 my-5 border-[1px] bg-red-200 bg-opacity-90 border-red-400 rounded-lg transition-all duration-700 ease-in-out">
                            <span class="xbg-inherit ml-5 text-xl cursor-pointer" onclick="this.parentElement.remove();">&times;</span>
                            <strong>Erreur!</strong> ' . htmlspecialchars($_GET['erreur']) . '
                        </div>';
            }


            echo    '<script>
                        let messageElement = document.getElementById("SwitAlair");
                        if (messageElement) {
                            messageElement.style.right = "0"; 
                        }
                        
                        setTimeout(function() {
                            if (messageElement) {
                                messageElement.remove();
                            }
                        }, 3000);
                </script>';
        }
    ?>

    <!-- Navigation -->
    <nav class="bg-white h-[4rem] shadow-md">
        <div class="container h-full mx-auto px-6 py-3">
            <div class="flex h-full items-center justify-between">
                <div class="flex h-full items-center">
                    <a href="../../index.php" class="text-2xl h-full font-bold">
                        <img src="../../../Public/assets/images/logo.png" alt="logo du site" class="h-full">
                    </a>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="<?= (isset($_GET['erreur'])) ? './connexion.php' : $_SERVER['HTTP_REFERER'] ?>" class="text-gray-600 border-[1px] border-red-600 rounded-md py-1 px-4  hover:text-red-600">Retour</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="min-h-screen bg-gradient-to-br from-blue-50 to-blue-100 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <!-- Form Container -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <!-- Form Header -->
                <div class="bg-gradient-to-r from-blue-600 to-blue-800 px-6 py-8 text-center">
                    <h2 class="text-3xl font-bold text-white mb-2">Rejoignez la communauté Youdemy</h2>
                    <p class="text-blue-100">Commencez votre parcours d'apprentissage dès aujourd'hui</p>
                </div>

                
                <!-- Form Content -->
                <div class="p-8">
                    <form class="space-y-8" action="../../Controllers/Autentification/proccessors/inscription.php" method="POST" enctype="multipart/form-data">
                        <!-- Role Selection -->
                        <div class="p-8 border-b border-gray-200">
                            <h3 class="text-xl font-semibold text-gray-700 mb-6 text-center">Choisissez votre rôle</h3>
                            <div class="flex justify-center space-x-6">
                                <label class="relative w-1/2 cursor-pointer">
                                    <input type="radio" name="role" value="Etudiant" class="peer sr-only" checked>
                                    <div class="flex flex-col items-center p-6 border-2 rounded-xl peer-checked:border-blue-600 peer-checked:bg-blue-50 hover:bg-gray-50 transition-all duration-200">
                                        <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mb-3">
                                            <i class="fas fa-user-graduate text-2xl text-blue-600"></i>
                                        </div>
                                        <h4 class="font-semibold text-gray-800">Étudiant</h4>
                                        <p class="text-sm text-gray-500 text-center mt-2">Accédez à des milliers de cours et développez vos compétences</p>
                                    </div>
                                </label>
        
                                <label class="relative w-1/2 cursor-pointer">
                                    <input type="radio" name="role" value="Enseignant" class="peer sr-only">
                                    <div class="flex flex-col items-center p-6 border-2 rounded-xl peer-checked:border-blue-600 peer-checked:bg-blue-50 hover:bg-gray-50 transition-all duration-200">
                                        <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mb-3">
                                            <i class="fas fa-chalkboard-teacher text-2xl text-blue-600"></i>
                                        </div>
                                        <h4 class="font-semibold text-gray-800">Enseignant</h4>
                                        <p class="text-sm text-gray-500 text-center mt-2">Partagez vos connaissances et créez des cours en ligne</p>
                                    </div>
                                </label>
                            </div>
                        </div>
                        
                        <!-- Hidden Role Input -->
                        <input type="hidden" name="user_role" id="user_role" value="Etudiant">
                        
                        <!-- Grid Layout -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <!-- Left Column -->
                            <div class="space-y-6">
                                <!-- Photo de profil -->
                                <div class="flex flex-col items-center space-y-4">
                                    <div class="h-24 w-24 rounded-full bg-blue-50 flex items-center justify-center border-2 border-blue-200">
                                        <i class="fas fa-user-circle text-4xl text-blue-300"></i>
                                    </div>
                                    <div class="w-full">
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Photo de profil</label>
                                        <input type="file" name="profile_image" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"/>
                                    </div>
                                </div>

                                <!-- Champs communs -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Nom complet</label>
                                    <input type="text" name="username" placeholder="Votre nom complet" class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition-colors duration-200"/>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                    <input type="email" name="emailInscr" placeholder="vous@example.com" class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition-colors duration-200"/>
                                </div>
                            </div>

                            <!-- Right Column -->
                            <div class="space-y-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Téléphone</label>
                                    <input type="tel" name="telephone" placeholder="+212 6 12 34 56 78" class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition-colors duration-200"/>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Mot de passe</label>
                                    <input type="password" name="password" placeholder="••••••••" class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition-colors duration-200"/>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Confirmer le mot de passe</label>
                                    <input type="password" placeholder="••••••••" class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition-colors duration-200"/>
                                </div>
                                
                                <!-- Ville -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Ville</label>
                                    <input type="text" name="city" placeholder="Votre ville" class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition-colors duration-200"/>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div>
                            <button type="submit" name="submitInscr" class="w-full bg-blue-600 text-white py-3 px-6 rounded-lg font-semibold text-lg hover:bg-blue-700 transition duration-200">
                                Créer mon compte
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Footer -->
                <div class="px-8 py-6 bg-gray-50 border-t border-gray-100">
                    <p class="text-center text-gray-600">
                        Déjà membre ? 
                        <a href="connexion.php" class="text-blue-600 font-semibold hover:text-blue-700">Connectez-vous</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>