<?php
if(isset($_POST['login_c'])) {
    print json_encode($_POST);
    exit;
}
    $layouts_ = array(
          'main_nav'    => true,
          'connexion'   => true,
          'footer'      => true,
        );