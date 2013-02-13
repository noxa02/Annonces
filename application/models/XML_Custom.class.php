<?php
class XML_Custom {
    
    public
    static function unserialize($xml) {
        $options = array(XML_UNSERIALIZER_OPTION_COMPLEXTYPE   => 'array',
                         XML_UNSERIALIZER_OPTION_ATTRIBUTE_KEY =>  array('user'     => 'handle',
                                                                         'group'    => 'name',
                                                                         '#default' => 'id'));

        $unserializer = &new XML_Unserializer($options);
        $status = $unserializer->unserialize($xml, false); 
        $data = $unserializer->getUnserializedData();

        return $data;
    }
}
