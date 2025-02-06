<?php
require_once "../../../vendor/autoload.php";
use App\Models\listecoursModels;

    $filterTag = $_GET['tagId'] ?? "";
    $filterCata = $_GET['CatalogueId'] ?? "";
    $Search = $_GET['Search'] ?? "";
    
    $role = 'Visiteur';
    if (isset($_SESSION['role'])) {
        $role = $_SESSION['role'];
    }

    $listCours = listecoursModels::ObjectsListe('listecours', "id_catalogue", $filterCata, "id_tag", $filterTag, "cours_titre", "createDate", $Search, 'Publicé') ?? [];
    $FormerCours = array_map(function($liste) use ($role){
        $image = stream_get_contents($liste->getData('userimage'));
        $imageCours = stream_get_contents($liste->getData('imageCours'));
        return [
            'id_cour' => $liste->getData('id_cour'),
            'cours_titre' => $liste->getData('cours_titre'),
            'catalogue_titre' => $liste->getData('catalogue_titre'),
            'description' => $liste->getData('description'),
            'imageCours' => base64_encode($imageCours),
            'id_user' => $liste->getData('id_user'),
            'username' => $liste->getData('username'),
            'email' => $liste->getData('useremail'),
            'image' => base64_encode($image),
            'createDate' => $liste->getData('createDate'),
            'id_tag' => $liste->getData('id_tag'),
            'tag_Titre' => $liste->getData('tag_Titre'),
            'role' => $role
        ];
    }, $listCours);
    
    echo json_encode($FormerCours);
    
    
    
    
    
    
    