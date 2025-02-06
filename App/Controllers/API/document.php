<?php
require_once "../../../vendor/autoload.php";
use App\Models\CoursModels;


if (isset($_GET['id'])) {
    $cours = CoursModels::find('id_cour', $_GET['id']);
    if ($cours['cours_contenu'] != null) {
        $document = $cours->getData('cours_contenu');
        header('Content-Type: application/pdf');
        header('Content-Length: ' . strlen($document));
        echo $document;
        exit;
    }
}
?>