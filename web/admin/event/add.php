<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use AppBundle\Entity\CategoryRepository;
use AppBundle\Entity\PlaceRepository;

$categoryRepository = new CategoryRepository();
$categories         = $categoryRepository->execute('SELECT_ALL');

$placeRepository = new PlaceRepository();
$places          = $placeRepository->execute('SELECT_ALL');

$loader   = new Twig_Loader_Filesystem($_SERVER['DOCUMENT_ROOT'] . '/app/resources/views/');
$twig     = new Twig_Environment($loader);

echo $twig->render('admin/event/add.html.twig', [
    'categories' => $categories,
    'places'     => $places
]);

?>