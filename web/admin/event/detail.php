<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use AppBundle\Entity\EventRepository;
use AppBundle\Entity\EventCategoriesRepository;
use AppBundle\Entity\CategoryRepository;
use AppBundle\Entity\PlaceRepository;

$loader = new Twig_Loader_Filesystem($_SERVER['DOCUMENT_ROOT'] . '/app/resources/views/');
$twig   = new Twig_Environment($loader);

// このページに直接アクセスしてきた場合はエラー画面遷移
if (!array_key_exists('id', $_GET)) {
    echo $twig->render('admin/error.html.twig', [
        'error' => '操作に誤りがありました。初めからやり直してください。',
    ]);
    exit();
}

// GETのidに該当するイベントレコードを取得
$eventRepository = new EventRepository();
$eventRepository->setId(htmlentities($_GET['id']));
$event = $eventRepository->execute('SELECT_ONE_BY');

// イベントに該当するカテゴリー情報を取得
$eventCategoriesRepository = new EventCategoriesRepository();
$eventCategoriesRepository->setEventId($event['id']);
$eventCategories = $eventCategoriesRepository->execute('SELECT_BY');

// カテゴリー名一覧を取得
$categoryRepository = new CategoryRepository();
$categories         = $categoryRepository->execute('SELECT_ALL');

// 会場一覧を取得
$placeRepository = new PlaceRepository();
$places          = $placeRepository->execute('SELECT_ALL');

echo $twig->render('admin/event/detail.html.twig', [
    'event'           => $event,
    'eventCategories' => $eventCategories,
    'categories'      => $categories,
    'places'          => $places
]);

?>