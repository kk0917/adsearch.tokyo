<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use AppBundle\Entity\ManagerRepository;

$managerRepository = new ManagerRepository();
$results = $managerRepository->execute('SELECT');

$loader = new Twig_Loader_Filesystem($_SERVER['DOCUMENT_ROOT'] . '/app/resources/views/');
$twig   = new Twig_Environment($loader);

echo $twig->render('admin/staff/index.html.twig', [
    'managers' => $results,
]);

?>