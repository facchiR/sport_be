<?php
namespace Models\Sport;

use Models\Table as Table;

class Categoria extends Table {
    
    const TABLE_NAME = "categorie";
    
    public $categoria;
    
    static function getBindings() {
        return[
            "id"=>"id",
            "categoria"=>"categoria"
        ];
    }
    public function __construct($categoria){
        $this->categoria = $categoria;
    }
}




