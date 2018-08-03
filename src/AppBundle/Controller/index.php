<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use AppBundle\Entity\EventRepository;
use AppBundle\Entity\PlaceRepository;
use AppBundle\Entity\CategoryRepository;
use AppBundle\Entity\EventCategoriesRepository;

// 開催中・開催予定イベントのレコードを取得
$eventRepository = new EventRepository();
$upcomingEvents  = $eventRepository->execute('SELECT_UPCOMING');

// 会場情報のレコードを取得
$placeRepository = new PlaceRepository();
$places          = $placeRepository->execute('SELECT_ALL');

// カテゴリ一覧を取得
$categoryRepository = new CategoryRepository();
$categories         = $categoryRepository->execute('SELECT_ALL');

// イベントカテゴリー一覧を取得
$eventCategoriesRepository = new EventCategoriesRepository();
$eventCategories           = $eventCategoriesRepository->execute('SELECT_CATEGORY_NAME');

$loader   = new Twig_Loader_Filesystem($_SERVER['DOCUMENT_ROOT'] . '/app/resources/views/');
$twig     = new Twig_Environment($loader);

echo $twig->render('index.html.twig', [
    'upcomingEvents'  => $upcomingEvents,
    'places'          => $places,
    'categories'      => $categories,
    'eventCategories' => $eventCategories
]);

?>
