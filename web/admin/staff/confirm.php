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

$manager = new ManagerRepository();

$manager->setAllProperties('INSERT');
$errors = $manager->validate();

if (count($errors)) {
    echo $twig->render('backend/staff/add.html.twig', [
        'manager' => $manager,
        'errors'  => $errors,
    ]);
} else {
    echo $twig->render('backend/staff/confirm.html.twig', [
        'manager' => $manager,
    ]);
}

?>