<?php
/**
 * Created by PhpStorm.
 * User: kamenashikou
 * Date: 2018/05/04
 * Time: 21:52
 */

require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use AppBundle\Entity\CategoryRepository;

$categoryRepository = new CategoryRepository();
$categoryRepository->setId($_GET['id']);
$categoryRepository->execute('DELETE');

echo $_GET['id'] . ' OK';
