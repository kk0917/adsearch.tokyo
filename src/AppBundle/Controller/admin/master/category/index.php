<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use AppBundle\Entity\CategoryRepository;

// カテゴリ一覧を取得
$categoryRepository = new categoryRepository();
$categories         = $categoryRepository->execute('SELECT_ALL');

$loader   = new Twig_Loader_Filesystem($_SERVER['DOCUMENT_ROOT'] . '/app/resources/views/');
$twig     = new Twig_Environment($loader);

echo $twig->render('admin/master/category/index.html.twig', [
    'categories' => $categories
]);

?>
