<?php
/**
 * Created by PhpStorm.
 * User: kamenashikou
 * Date: 2018/05/04
 * Time: 21:52
 */

require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use AppBundle\Entity\EventRepository;

$eventRepository = new EventRepository();
$eventRepository->setId($_GET['id']);
$eventRepository->execute('DELETE');

echo $_GET['id'] . ' OK';