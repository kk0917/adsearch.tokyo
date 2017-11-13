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

echo'<pre>';print_r($_POST);echo'</pre>';exit;

move_uploaded_file($_FILES['main_image']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/web/uploads/' . $_FILES['main_image']['name']);

// TODO: 画像の幅、高さチェック
echo'<pre>';print_r($_FILES);print_r(getimagesize($_SERVER['DOCUMENT_ROOT'] . '/web/uploads/' . $_FILES['main_image']['name']));echo'</pre>';exit;

if (count($errors)) {
    echo $twig->render('admin/staff/add.html.twig', [
        'manager' => $manager,
        'errors'  => $errors,
    ]);
} else {
    echo $twig->render('admin/staff/addConfirm.html.twig', [
        'manager' => $manager,
    ]);
}

?>