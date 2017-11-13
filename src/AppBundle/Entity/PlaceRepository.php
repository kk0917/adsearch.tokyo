<?php
/**
 * Created by PhpStorm.
 * User: kkkk
 * Date: 2017/11/13
 * Time: 22:29
 */

namespace AppBundle\Entity;

use AppBundle\Common\DatabaseAccessObject;

class PlaceRepository
{
    public function execute($type)
    {
        $dbObject = new DatabaseAccessObject();

        $sql = '';
        $values = [];

        switch ($type) {
            case 'SELECT_ALL':
                $sql = 'SELECT * FROM place WHERE is_deleted = FALSE ORDER BY id';

                return $dbObject->run('SELECT_ALL', $sql);
                break;
        }
    }
}