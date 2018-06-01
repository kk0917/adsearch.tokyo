<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

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

// GETのidに該当する会場レコードを取得
$placeRepository = new PlaceRepository();
$placeRepository->setId(htmlentities($_GET['id']));
$place = $placeRepository->execute('FIND');

echo $twig->render('admin/master/place/detail.html.twig', [
    'place' => $place
]);

?>
