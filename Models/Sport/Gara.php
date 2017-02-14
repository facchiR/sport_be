<?php

namespace Models\Sport;

use Models\Table as Table;

class Gara extends Table{
    
    const TABLE_NAME = "gare";
    
    public $gara;
    public $km;
    public $orapartenza;
    public $luogopartenza;
    public $luogoarrivo;
    
    public function __construct($gara, $km, $orapartenza, $luogopartenza, $luogoarrivo, $cat="") {
        $this->gara = $gara;
        $this->km = $km;
        $this->orapartenza = $orapartenza;
        $this->luogopartenza = $luogopartenza;
        $this->luogoarrivo = $luogoarrivo;       
    }
    
    static function getBindings() {
        return["id"=>"id",
               "gara"=>"gara",
               "km"=>"km",
                "orapartenza"=>"orapartenza",
                "luogopartenza"=>"luogopartenza",
                "luogoarrivo"=>"luogoarrivo"
            ];
    }
    
}

