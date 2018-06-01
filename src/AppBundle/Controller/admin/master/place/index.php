<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use AppBundle\Entity\PlaceRepository;

// 会場一覧を取得
$placeRepository = new PlaceRepository();
$places          = $placeRepository->execute('SELECT_ALL');

$loader   = new Twig_Loader_Filesystem($_SERVER['DOCUMENT_ROOT'] . '/app/resources/views/');
$twig     = new Twig_Environment($loader);

echo $twig->render('admin/master/place/index.html.twig', [
    'places' => $places
]);

?>
