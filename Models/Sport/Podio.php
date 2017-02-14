<?php

namespace Models\Sport;

use Models\Table as Table;

class Podio extends Models\Table{
    
    const TABLE_NAME = "podio";
    
    public $nome;
    public $cf;
    public $pettorale;
    public $gara;
    public $km;
    public $categoria;
    public $tempo;
    
    static function getBindings(){
        return[
            "id"=>"id",
            "nome"=>"nome",
            "cf"=>"cf",
            "pettorale"=>"pettorale",
            "km"=>"km",
            "categoria"=>"categoria",
            "tempo"=>"tempo"
        ];
    }
}
