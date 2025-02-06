<?php
namespace App\Controllers;

use App\Models\Requites;

    class Catalogues {
        protected $id_catalogue;
        protected $catalogue_titre;
        private $catalogue_contenu;
        private $catalogue_image;

        public function __construct($id=null, $titre=null, $contenu=null, $image=null) 
        {
            $this->id_catalogue = $id;
            $this->catalogue_titre = $titre;    
            $this->catalogue_contenu = $contenu;
            $this->catalogue_image = $image;
        }

        public function setData($name, $value) {
            $this->$name = $value;
        }
        
        public function getData($name) {
            return $this->$name;
        }

        public static function pagination($totalPage) {
            $rqt = new Requites();
            $countCata = $rqt->selectCount('catalogues');
            return ceil($countCata/$totalPage);
        }

        public final function SelectorCatal($id) {
            $selected = ($id == $this->id_catalogue) ? "selected" : "" ;
            echo '<option '. $selected .' value="'. $this->id_catalogue .'">'. $this->catalogue_titre .'</option>';
        }

        public function AjouterData(){
            $requite = new Requites();
            $values = [
                'catalogue_titre' => $this->catalogue_titre,
                'catalogue_contenu' => $this->catalogue_contenu,
                'catalogue_image' => $this->catalogue_image
            ];
            return $requite->insertData('catalogues', $values);
        }

        public function modifyCatalogue() {
            $requite = new Requites();
            $values = [
                'catalogue_titre' => $this->catalogue_titre,
                'catalogue_contenu' => $this->catalogue_contenu,
            ]; 
            if ($this->catalogue_image != null) {
                $values ['catalogue_image'] = $this->catalogue_image;
            }
            var_dump($values);

            return $requite->update('catalogues', $values, 'id_catalogue', $this->id_catalogue);
        }

        public function toString() {
            $requite = new Requites();
            $Countvéhicule = $requite->selectCount('cours', 'id_catalogue', $this->id_catalogue, 'int');

            echo '<div class="bg-white rounded-xl shadow-lg hover:shadow-black overflow-hidden">
                        <img src="data:image/png;base64,'. htmlspecialchars(base64_encode($this->catalogue_image)) .'" alt="Catalogue" class="w-full h-60 object-cover">
                        <div class="p-4">
                            <div class="flex justify-between items-start">
                                <div>
                                    <p class="text-sm text-gray-500">ID: #'. htmlspecialchars($this->id_catalogue) .'</p>
                                    <h3 class="text-xl font-semibold text-gray-900">'. htmlspecialchars($this->catalogue_titre) .'</h3>
                                </div>
                                <div class="flex gap-2">
                                    <a href="?Modifier='.htmlspecialchars($this->id_catalogue).'">
                                        <button class="text-blue-500 hover:text-blue-600">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </a>
                                    <a href="./crud/deleteCatégo.php?DeleteCatégorie='.htmlspecialchars($this->id_catalogue).'">
                                        <button class="text-red-500 hover:text-red-600">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </a>
                                </div>
                            </div>
                            <p class="text-gray-600 mt-2 pb-2">'. htmlspecialchars($this->catalogue_contenu) .'</p>
                            <div class="mt-4 pt-4 border-t">
                                <p class="text-gray-600">'.htmlspecialchars($Countvéhicule).' Cours disponibles</p>
                            </div>
                        </div>
                    </div>';
        }
    }