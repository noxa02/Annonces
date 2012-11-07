<?php

function print_log($vars_) {
    print '<pre>';
        var_dump($vars_);
    print '</pre>';
}

function print_logex($vars_) {
    print '<pre>';
        var_dump($vars_);
    print '</pre>';
    exit;
}