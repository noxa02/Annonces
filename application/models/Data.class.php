<?php

class Data {
    
    /**
     * @param array $data
     * @param object $object
     * @param boolean $return (if we want a return = true)
     * @return object $object
     * Extract array values to return an initialized object
     */
    public 
    function initObject($data, $object, $return = false, $initObject = true, $opts = array()) {

        if(is_a($object, 'stdClass')) {
            
            $object = new stdClass();
            if(isset($data) && !empty($data)) {
               foreach ($data as $key => $value) { 
                   $object->$key = $value;
               }
            }
            
        } else {
            
            if($initObject) {
                $object = new $object(); 
            }
            
            if(isset($data) && !empty($data)) {
                
               foreach ($data as $key => $value) {
                   $_methodName = ucfirst($key);
                   if(strpos($key, '_')) {
                       $beginMethod = ucfirst(strstr($key, '_', true));
                       $endMethod = ucfirst(str_replace('_', '', strstr($key, '_')));
                       $_methodName = $beginMethod.$endMethod;
                   }

                   $_method = 'set'.$_methodName;
                   if(method_exists($object, $_method)) {
                       if($_method == 'setPassword') {
                           $object->$_method($value, true);
                       } else {
                           $object->$_method($value);
                       }

                   }
               }
            }     
        }

        if($return) {
            return $object;
        }
    }
}
