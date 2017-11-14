<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use AppBundle\Entity\ManagerRepository;

$loader   = new Twig_Loader_Filesystem($_SERVER['DOCUMENT_ROOT'] . '/app/resources/views/');
$twig     = new Twig_Environment($loader);

// このページに直接アクセスしてきた場合はエラー画面遷移
if (!array_key_exists('id', $_GET)) {
    echo $twig->render('admin/error.html.twig', [
        'error' => '操作に誤りがありました。初めからやり直してください。',
    ]);
    exit();
}

$managerRepository = new ManagerRepository();
$managerRepository->setId(htmlentities($_GET['id']));
$result = $managerRepository->execute('SELECT_BY_ONE');

echo $twig->render('admin/manager/edit.html.twig', [
    'manager' => $result
]);

?>