<?php

namespace Models\Sport;

use Models\Table as Table;

class Gara extends Table {

    const TABLE_NAME = "gare";

    public $gara;
    public $km;
    public $orapartenza;
    public $luogopartenza;
    public $luogoarrivo;
    public $cat = "";

    public function __construct($id = 0, $params = []) {

        parent::init($this, $id);

        foreach ($params as $k => $v) {
//            if(is_array($v)){
//                $this->$k = 
//                        array_map(function($i){return is_int($i)?$i:$i->id;}, $v);
//                $this->$k = array_unique($this->$k);
//                sort($this->$k);
//            }else{
            $this->$k = $v;
            //}       
        }

        // $this->load($id);
    }

//    public function __construct($gara, $km, $orapartenza, $luogopartenza, $luogoarrivo, $cat="") {
//        $this->gara = $gara;
//        $this->km = $km;
//        $this->orapartenza = $orapartenza;
//        $this->luogopartenza = $luogopartenza;
//        $this->luogoarrivo = $luogoarrivo;       
//    }
//    
    static function getBindings() {
        return["id" => "id",
            "gara" => "gara",
            "km" => "km",
            "orapartenza" => "orapartenza",
            "luogopartenza" => "luogopartenza",
            "luogoarrivo" => "luogoarrivo",
            "categorie_id" => "cat"
        ];
    }

    protected function load($id) {
        parent::load($id, $this);
        $this->loadCat();
    }

    public function save() {
        parent::save();
        $this->store();
    }

//   

    public function loadCat() {
        try {
            $sql = "SELECT id FROM categorie WHERE id = :id ORDER BY id";
            $stmt = self::$db->prepare($sql);
            if ($stmt->execute([":id" => $this->cat])) {
                // $this->cat = $this->id; 
                $categorie = $stmt->fetch();
            }
        } catch (\PDOException $e) {
            die($e->getMessage());
        }
    }

    public function storeCat() {
        try {
            // rimuovo quelle relazioni che non valgono piu
            $sql = "UPDATE categorie SET gare_id = null WHERE id NOT IN (" .
                    join(", ", $this->cat) . ") AND gare_id = :id";
            $stmt = self::$db->prepare($sql);
            $stmt->execute([":id" => $this->id]);
        } catch (\PDOException $e) {
            die($e->getMessage());
        }

        if (count($this->categorie)) {
            try {
                // aggiungo quelle relazione che valgono da adesso
                $sql = "UPDATE iscrizioni SET gare_id = :id WHERE id IN (" .
                        join(", ", $this->cat) . ")";
                $stmt = self::$db->prepare($sql);
                $stmt->execute([":id" => $this->id]);
            } catch (\PDOException $e) {
                die($e->getMessage());
            }
        }
    }

}
