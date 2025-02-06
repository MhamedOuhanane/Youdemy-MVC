<?php
namespace App\Controllers;

    class tags {
        private $id;
        private $tagTitre;

        public function __construct($id=null, $tags=null)
        {
            $this->id = $id ;
            $this->tagTitre = $tags ;
        }


        public function __set($name, $value)
        {
            $this->$name  = $value;
        }

        public function __get($name){
            return $this->$name;
        }

        public function toString($tags = null){
            $selected = "";
            if ($tags != null) {
                foreach($tags as $tag) {
                    if ($tag['id_tag'] == $this->id) {
                        $selected = "selected";
                    }
                }
            }
            return $selected;
        }

        // public function toStringDash() {
        //     echo '<div class="bg-white rounded-xl shadow-lg hover:shadow-black overflow-hidden hover:scale-105">
        //                 <div class="p-4">
        //                     <div class="flex justify-between items-start">
        //                         <div>
        //                             <p class="text-sm text-gray-500">ID: #'. htmlspecialchars($this->id) .'</p>
        //                             <h3 class="text-xl font-semibold text-gray-900">'. htmlspecialchars($this->tagTitre) .'</h3>
        //                         </div>
        //                         <div class="flex gap-2">
        //                             <a href="?Modifier='.htmlspecialchars($this->id).'">
        //                                 <button class="text-blue-500 hover:text-blue-600">
        //                                     <i class="fas fa-edit"></i>
        //                                 </button>
        //                             </a>
        //                             <a href="./crud/deletetags.php?Deletetags='.htmlspecialchars($this->id).'">
        //                                 <button class="text-red-500 hover:text-red-600">
        //                                     <i class="fas fa-trash"></i>
        //                                 </button>
        //                             </a>
        //                         </div>
        //                     </div>
        //                 </div>
        //             </div>';
        // }

        // public function insertTags() {
        //     $requite = new Requites();
        //     $Array =$requite->selectWhere('tags', 'tag_Titre', $this->tagTitre);
        //     if ($Array == null) {
        //         $values = [
        //             'tag_Titre' => $this->tagTitre
        //         ];
        //         $requite->insertData('tags', $values);
        //     }
        // }

        // public function totalTags() {
        //     $requite = new Requites();
        //     return $requite->selectCount('tags');
        // }
    }