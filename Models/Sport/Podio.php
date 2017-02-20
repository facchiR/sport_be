<?php

namespace Models\Sport;

use Models\Table as Table;

class Podio extends Table{
    
    const TABLE_NAME = "podio";
    
    public $nome;
    public $cf;
    public $pettorale;
    public $gara;
    public $km;
    public $categoria;
    public $tempo;
    
    public function __construct($id = 0, $params = []){
        
        parent::init($this, $id);
        
        foreach($params as $k => $v){
            if(is_array($v)){
                $this->$k = 
                        array_map(function($i){return is_int($i)?$i:$i->id;}, $v);
                $this->$k = array_unique($this->$k);
                sort($this->$k);
            }else{
                $this->$k = $v;
            }       
        }
    }
    
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
