<?php
[@namespace];

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class [@classname] extends Model {

	
        protected $table = '[@table]';
               
        
        protected $primaryKey = '[@primary_key]';

        
        public $timestamps = [@timestamp];
        
    	  
        protected $softDelete = [@soft_delete];

        public static $attribute_list = array(
[@attrbute_list]
                    );
        
        public static $attribute_label = array(
[@attrbute_label]
                    );
        
        public static function validate($data){
            return Validator::make($data,seft::$attribute_list);
        }
        

}
