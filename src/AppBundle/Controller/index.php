<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use AppBundle\Entity\EventRepository;
use AppBundle\Entity\PlaceRepository;

// 開催中・開催予定イベントのレコードを取得
$eventRepository = new EventRepository();
$upcomingEvents  = $eventRepository->execute('SELECT_UPCOMING');

// 会場情報のレコードを取得
$placeRepository = new PlaceRepository();
$places          = $placeRepository->execute('SELECT_ALL');

$loader   = new Twig_Loader_Filesystem($_SERVER['DOCUMENT_ROOT'] . '/app/resources/views/');
$twig     = new Twig_Environment($loader);

echo $twig->render('index.html.twig', [
    'upcomingEvents' => $upcomingEvents,
    'places'         => $places
]);

?>
