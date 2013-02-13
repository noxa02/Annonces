<?php require_once '../application/bootstrap.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="fr">
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <link rel="icon" type="image/png" href="<?=BASE_URL ?>images/favicon24x24.png" />
        <title>
            <?=DOCUMENT_TITLE?><?php if(isset($document_title)): print $document_title; endif;?>
        </title>
        <!-- Bootstrap -->
        <link href="<?=BASE_URL ?>/bootstrap/css/bootstrap.css" rel="stylesheet">
        <link href="<?=BASE_URL ?>/css/all.css" rel="stylesheet">
        <link href="<?=BASE_URL ?>/css/toastr-1.0.2/toastr.css" rel="stylesheet">
        <!-- Library requiered -->
        <script type="text/javascript">
            var BASE_URL = '<?=BASE_URL?>';
            var WS_PATH = 'http://localhost:8888/projetcs/REST_ANNONCE_V2/web';
        </script>
        <script type="text/javascript" src="<?=BASE_URL?>/js/jquery.1.8.1.js"></script>
        <script type="text/javascript" src="<?=BASE_URL?>/js/jquery.base64.js"></script>
        <script type="text/javascript" src="<?=BASE_URL?>/js/jquery.json-2.4.js"></script>
        <script type="text/javascript" src="<?=BASE_URL?>/bootstrap/js/bootstrap.js"></script>
        <script type="text/javascript" src="<?=BASE_URL?>/js/toastr-1.0.2/toastr.js"></script>
        <script type="text/javascript" src="<?=BASE_URL?>/js/date-format.js"></script>
        <script type="text/javascript" src="<?=BASE_URL?>/js/jquery-cookie.js"></script>
        <!-- Custom Scripts -->
        <script type="text/javascript" src="<?=BASE_URL?>/js/Form/Form.js"></script>
        <script type="text/javascript" src="<?=BASE_URL?>/js/notifications.js"></script>
        <script type="text/javascript" src="<?=BASE_URL?>/js/main.js"></script>
        <script type="text/javascript" src="<?=BASE_URL?>/js/Ajax/User.js"></script>
        <script type="text/javascript" src="<?=BASE_URL?>/js/Ajax/Announcement.js"></script>
        <script type="text/javascript" src="<?=BASE_URL?>/js/Ajax/Search.js"></script>
        <script type="text/javascript" src="<?=BASE_URL?>/js/Model/Master.js"></script>
    </head>
    <body>
    <?php 
    if(isset($layouts['navbar']) && $layouts['navbar'])
        require_once APPLICATION_PATH . '/layouts/navbar.layout.php';
    ?>
    <?php  if(isset($view)) require_once $view; ?>
    <?php
    if(isset($layouts['footer']) && $layouts['footer'])
        require_once  APPLICATION_PATH . '/layouts/footer.layout.php';
    ?>
    </body>
</html>