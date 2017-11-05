<?php

require_once '/Applications/MAMP/htdocs/adsearch.tokyo/vendor/autoload.php';

// テンプレートファイルがあるディレクトリ
$loader   = new Twig_Loader_Filesystem('/Applications/MAMP/htdocs/adsearch.tokyo/app/resources/views/');
$twig     = new Twig_Environment($loader);
//$template = $twig->loadTemplate('sample.html.twig');

echo $twig->render('frontend/sample.html.twig', [
    'title'    => 'sample',
    'message'  => 'My Webpage!',
]);

?>