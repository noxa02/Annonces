<?php

function print_log($vars) 
{
    print '<pre>';
        var_dump($vars);
    print '</pre>';
}

function print_logex($vars) 
{
    print '<pre>';
        var_dump($vars);
    print '</pre>';
    exit;
}

function sha1_password($password) 
{
    $GDS_1 = 'sdafazc532D2deq';
    $GDS_2 = 'qsfqsgugre8795h';
    
    return sha1(sha1($password.$GDS_2).sha1($GDS_1.$GDS_2));
}

function cleanArray(&$array_, $value_) {
    if(is_array($array_)) {
        foreach($array_ as $key=>&$arrayElement) {
            if(is_array($arrayElement)) {
                cleanArray($arrayElement, $value_);
            } else {
                if($arrayElement == $value_) {
                    unset($array_[$key]);
                }
            }
        }
    }
}

function refreshArrayKeys(Array $array_) {
    return array_values($array_);
}