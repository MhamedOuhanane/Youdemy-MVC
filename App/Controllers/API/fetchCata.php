<?php
require_once "../../../vendor/autoload.php";

use App\Models\CataloguesModels;
use App\Models\Requites;
    $pagination = (int) ($_GET['pagination'] ?? 3);
    $NBpage = (int) ($_GET['NBpage'] ?? 1);
    
    $catalogues = CataloguesModels::ObjectsCatalogues();
    $rows = []; 
    if ($catalogues) {
        $i = 0;
        $b = 0;
        foreach($catalogues as $catalogue) {
            $rows[$i][] = $catalogue;
            $b++;
            if ($b >= $pagination) {
                $b = 0;
                $i++;
            }
        }
        $formerCatalogues = array_map(function($row) {#use ($requite){
            // $countCours = $requite->selectCount('cours', 'id_catalogue', $row['id_catalogue']);
            $image = stream_get_contents($row->getData('catalogue_image'));
            return [
                'id_catalogue' => $row->getData('id_catalogue'),
                'catalogue_titre' => $row->getData('catalogue_titre'),
                'catalogue_contenu' => $row->getData('catalogue_contenu'),
                'catalogue_image' => base64_encode($image),
                // 'coursCount' => $countCours
            ];
        },$rows[$NBpage-1]);
        
        echo json_encode($formerCatalogues);
    } else {
        echo json_encode([]);
    }

