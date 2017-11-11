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

// このページに直接アクセスしてきた場合はエラー画面遷移
if (count($_POST) == 0) {
    echo $twig->render('admin/error.html.twig', [
        'error' => '操作に誤りがありました。初めからやり直してください。',
    ]);
    exit();
}

$manager = new ManagerRepository();
$manager->setProperties('UPDATE');
$errors = $manager->validate('UPDATE');

// パスワードを保護するためにハッシュ化
$manager->setPassword(password_hash($manager->getPassword(), PASSWORD_DEFAULT));
$manager->setPasswordConfirm('');

if (count($errors)) {
    echo $twig->render('admin/staff/edit.html.twig', [
        'manager' => $manager,
        'errors'  => $errors,
    ]);
} else {
    echo $twig->render('admin/staff/editConfirm.html.twig', [
        'manager' => $manager,
    ]);
}

?>