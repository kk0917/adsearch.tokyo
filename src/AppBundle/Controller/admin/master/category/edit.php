<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use AppBundle\Entity\CategoryRepository;

// このページに直接アクセスしてきた場合はエラー画面遷移
if (count($_POST) == 0) {
    echo $twig->render('admin/error.html.twig', [
        'error' => '操作に誤りがありました。初めからやり直してください。',
    ]);
    exit();
}

$categoryRepository = new CategoryRepository();
$categoryRepository->setProperties('UPDATE');

$errors = $categoryRepository->validate();
if (count($errors)) {
    http_response_code(400);
    echo json_encode($errors);
    exit;
}

$categoryRepository->execute('UPDATE');

echo $_POST['id'] . ' OK';
