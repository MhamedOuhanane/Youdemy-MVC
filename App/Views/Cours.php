<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Youdemy - Cours</title>
    <link
        rel = "shortcut icon"
        href = "../../Public/assets/images/logo_icone.png"
        type = "image/png"
    >
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js"></script>
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
</head>

<body class="bg-gray-50">
    <?php require_once "./components/header.php" ?>
    <!-- Search Section -->
    <div class="container mx-auto px-6 py-8">
        <div class="flex flex-col md:flex-row gap-4 justify-between mb-8">
            <div class="relative flex-1">
                <input id="InputSearch" type="search" 
                    class="w-full pl-10 pr-4 py-3 border rounded-lg focus:outline-none focus:border-blue-500" 
                    placeholder="Rechercher un cours...">
                <div class="absolute left-3 top-3.5 text-gray-400">
                    <i class="fas fa-search"></i>
                </div>
            </div>
            <div class="flex gap-4">
                <select id="selectCatalogue" class="px-4 py-3 border rounded-lg focus:outline-none focus:border-blue-500">
                    <option value="">Filtrer par catalogue</option>
                    <?php
                        $catalgue = Catalogues::GETCATALOGUE();
                        if ($catalgue) {
                            foreach($catalgue as $catalo) {
                                $id = $_GET['idCatalogue'] ?? null;
                                $catalo->SelectorCatal($id);
                            }
                        }
                    ?>
                </select>
                <select id="selectTags" class="px-4 py-3 border rounded-lg focus:outline-none focus:border-blue-500">
                    <option value="">Filtrer par tag</option>
                    <?php
                        $tags = tags::GETTAGS();
                        if ($tags) {
                            foreach($tags as $tag) {
                                $tag->toString();
                            }
                        }
                    ?>
                </select>
            </div>
        </div>

        <!-- Courses Grid -->
        <div id="CoursesGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3  gap-8">
            <!-- Courses Cards -->
            
        </div>
    </div>

    <?php require_once "./components/footer.php" ?>
    <script src="../../assets/js/coursEtud.js"></script>
</body>
</html>