<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use AppBundle\Entity\EventRepository;

$eventRepository = new EventRepository();

// 開催中・開催予定イベントのレコードを取得
$upcomingEvents  = $eventRepository->execute('SELECT_UPCOMING');

// 過去イベントのレコードを取得
$pastEvents = $eventRepository->execute('SELECT_PAST');

$loader = new Twig_Loader_Filesystem($_SERVER['DOCUMENT_ROOT'] . '/app/resources/views/');
$twig   = new Twig_Environment($loader);

echo $twig->render('admin/event/index.html.twig', [
    'upcomingEvents' => $upcomingEvents,
    'pastEvents'     => $pastEvents
]);

?>