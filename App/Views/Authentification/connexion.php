<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Youdemy - Connexion</title>
    <link
        rel="shortcut icon"
        href="../../assets/images/logo_icone.png"
        type="image/png"
    />
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    </head>
<body class="bg-gray-50 font-family-karla h-screen">
    <!-- Afficher les messages et les erreur de connexion -->
    <?php
        if (isset($_GET)) {
            if (isset($_GET['message'])) {
                echo '
                <div id="SwitAlair" class="absolute w-[28rem] right-[-28rem] p-5 my-5 border-[1px] bg-green-200 bg-opacity-90 border-green-400 rounded-lg transition-all duration-700 ease-in-out">
                    <span class="xbg-inherit ml-5 text-xl cursor-pointer" onclick="this.parentElement.remove();">&times;</span>
                    <strong>Succès!</strong> ' . htmlspecialchars($_GET['message']) . '
                </div>';
            } else if (isset($_GET['erreur'])) {
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
                        }, 6000);
                </script>';
        }
    ?>
    <div class="w-full flex flex-wrap">

        <!-- Section Connexion -->
        <div class="w-full md:w-1/2 flex flex-col">

            <div class=" flex justify-between pt-12 md:px-12">
                <a href="../home.php">
                    <img src="../../../Public/assets/images/logo.png" alt="Logo du site" class="h-12">
                </a>
                <div class="flex items-center space-x-4">
                    <a href="../home.php" class="text-gray-600 border-[1px] border-red-600 rounded-md py-1 px-4  hover:text-red-600">Retour</a>
                </div>
            </div>

            <div class="flex flex-col justify-center md:justify-start pt-8 md:pt-4 px-8 md:px-24 lg:px-32">
                <p class="text-center text-3xl">Bienvenue.</p>
                <form class="flex flex-col pt-3 md:pt-4" action="./proccessors/auth.php" method="POST">
                    <div class="flex flex-col pt-4">
                        <label for="email" class="text-lg">Email</label>
                        <input type="email" name="emailConnex" id="email" placeholder="votre@email.com" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-200 focus:border-blue-500">
                        <span class="hidden text-red-500">Email incorrect</span>
                    </div>
    
                    <div class="flex flex-col pt-4">
                        <label for="password" class="text-lg">Mot de passe</label>
                        <input type="password" name="password" id="password" placeholder="Mot de passe" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-200 focus:border-blue-500">
                        <span class="hidden text-red-500">Mot de passe incorrect</span>
                    </div>
    
                    <input type="submit" name="submitConne" value="Se connecter" class="bg-blue-600 text-white font-bold text-lg hover:bg-blue-700 p-2 mt-8 rounded transition duration-200">
                </form>
                <div class="text-center pt-12 pb-12">
                    <p>Vous n'avez pas de compte ? <a href="inscription.php" class="text-blue-600 font-semibold hover:text-blue-700">Inscrivez-vous ici.</a></p>
                </div>
            </div>

        </div>

        <!-- Section Image -->
        <div class="w-1/2 shadow-2xl">
            <img class="object-fill w-full h-screen hidden md:block" src="../../../Public/assets/images/connexion-image.jpg">
        </div>
    </div>
    
    <script src="../../../Public/assets/js/connexion.js"></script>
</body>
</html>