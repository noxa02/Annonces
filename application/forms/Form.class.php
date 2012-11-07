<?php

/*
 *     $form_ = new Form();
       print $form_->createInput(
                $type = 'text', 
                array(
                        'classes'       => 'span2',
                        'id'            => 'aze',
                        'name'          => 'aze',
                        'placeholder'   => 'Test',
                )
            );
 * 
 */

/**
 * Description of Form
 *
 * @author Hait
 */
class Form {
    private $input_;
    public function __construct() {
        $this->input_ = null;
    }
    
    public function createInput($type = null, $opts) {
        $output_ = '';
        
        if(isset($type)):
            switch ($type) {
                case 'text':
                    $output_ = '<input type="text" ';
                    if(isset($opts) && !empty($opts)):
                        
                        if(isset($opts['classes'])):
                            $classes_ = $opts['classes'];
                        endif;
                        
                        if(isset($opts['name'])):
                           $name_ = $opts['name'];
                        endif;    
                         
                        if(isset($opts['id'])):
                            $id_ = $opts['id'];
                        endif;    
                         
                        if(isset($opts['placeholder'])):
                            $placeholder_ = $opts['placeholder'];
                        endif;    
                        
                    endif;
                    
                    if(!empty($classes_)): $output_ .= 'class="'.$classes_.'"'; endif;
                    if(!empty($name_)): $output_ .= 'name="'.$name_.'"'; endif;
                    if(!empty($id_)): $output_ .= 'id="'.$id_.'"'; endif;
                    if(!empty($placeholder_)): $output_ .= 'placeholder="'.$placeholder_.'"'; endif;
                    
                    $output_ .= ' />';
                    break;
            }
        endif;
        
        return $output_;
    }
}

?>
