<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use AppBundle\Entity\PlaceRepository;

// このページに直接アクセスしてきた場合はエラー画面遷移
if (count($_POST) == 0) {
    echo $twig->render('admin/error.html.twig', [
        'error' => '操作に誤りがありました。初めからやり直してください。',
    ]);
    exit();
}

$placeRepository = new PlaceRepository();
$placeRepository->setProperties('INSERT');

$errors = $placeRepository->validate();
if (count($errors)) {
    http_response_code(400);
    echo json_encode($errors);
    exit;
}
$placeRepository->checkUploadImage();
$placeId = $placeRepository->execute('INSERT');

echo $placeId . ' INSERT OK';
