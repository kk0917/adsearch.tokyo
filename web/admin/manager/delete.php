<?php
/**
 * Created by PhpStorm.
 * User: kamenashikou
 * Date: 2017/11/08
 * Time: 15:18
 */

require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use AppBundle\Entity\ManagerRepository;

$managerRepository = new ManagerRepository();
$managerRepository->setId($_GET['id']);
$managerRepository->execute('DELETE');

echo $_GET['id'] . ' OK';