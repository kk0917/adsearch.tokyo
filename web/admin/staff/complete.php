<?php
/**
 * Created by PhpStorm.
 * User: kamenashikou
 * Date: 2017/11/06
 * Time: 20:09
 */

require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use AppBundle\Entity\ManagerRepository;

$loader = new Twig_Loader_Filesystem($_SERVER['DOCUMENT_ROOT'] . '/app/resources/views/');
$twig   = new Twig_Environment($loader);

$managerRepository = new ManagerRepository();

$managerRepository->setAllProperties('INSERT');

// POSTで値渡しのため念のため完了画面でもバリデート
// & このページに直接アクセスしてきた場合はエラー画面遷移
$errors = $managerRepository->validate();
if (count($_POST) == 0 || count($errors)) {
    echo $twig->render('admin/error.html.twig', [
        'error' => '操作に誤りがありました。初めからやり直してください。',
    ]);
    exit();
}

$managerRepository->execute('INSERT');

echo $twig->render('admin/staff/complete.html.twig', [
    'username' => $managerRepository->getUsername(),
]);

?>