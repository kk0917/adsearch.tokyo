<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

// テンプレートファイルがあるディレクトリ
$loader   = new Twig_Loader_Filesystem($_SERVER['DOCUMENT_ROOT'] . '/app/resources/views/');
$twig     = new Twig_Environment($loader);
//$template = $twig->loadTemplate('sample.html.twig');

echo $twig->render('backend/index.html.twig', [
    'title'    => 'sample',
    'message'  => 'My Webpage!',
]);

?>