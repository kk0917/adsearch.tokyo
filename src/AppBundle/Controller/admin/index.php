<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

$loader   = new Twig_Loader_Filesystem($_SERVER['DOCUMENT_ROOT'] . '/app/resources/views/');
$twig     = new Twig_Environment($loader);

echo $twig->render('admin/index.html.twig');

?>