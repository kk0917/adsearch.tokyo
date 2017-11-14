<?php
/**
 * Created by PhpStorm.
 * User: kamenashikou
 * Date: 2017/11/06
 * Time: 20:09
 */

require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use AppBundle\Entity\EventRepository;
use AppBundle\Entity\CategoryRepository;
use AppBundle\Entity\PlaceRepository;

$loader = new Twig_Loader_Filesystem($_SERVER['DOCUMENT_ROOT'] . '/app/resources/views/');
$twig   = new Twig_Environment($loader);

// このページに直接アクセスしてきた場合はエラー画面遷移
if (count($_POST) == 0) {
    echo $twig->render('admin/error.html.twig', [
        'error' => '操作に誤りがありました。初めからやり直してください。',
    ]);
    exit();
}

$eventRepository = new EventRepository();
$eventRepository->setProperties('INSERT');
$errors = $eventRepository->validate();
$eventRepository->checkUploadImage();

// 入力エラーだった場合に入力ページに戻るのでカテゴリー名と開催場所を取得し渡してあげる
  // カテゴリー名一覧を取得
$categoryRepository = new CategoryRepository();
$categories         = $categoryRepository->execute('SELECT_ALL');

  // 会場一覧を取得
$placeRepository = new PlaceRepository();
$places          = $placeRepository->execute('SELECT_ALL');

// 入力エラー有無に応じて遷移ページ切り替え
if (count($errors)) {
    echo $twig->render('admin/event/add.html.twig', [
        'event'      => $eventRepository,
        'errors'     => $errors,
        'categories' => $categories,
        'places'     => $places
    ]);
} else {
    echo $twig->render('admin/event/addConfirm.html.twig', [
        'event' => $eventRepository,
        'categories' => $categories,
        'places'     => $places
    ]);
}

?>