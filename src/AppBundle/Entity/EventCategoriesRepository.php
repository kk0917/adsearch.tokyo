<?php
/**
 * Created by PhpStorm.
 * User: kkkk
 * Date: 2017/11/16
 * Time: 13:46
 */

namespace AppBundle\Entity;

use AppBundle\Common\DatabaseAccessObject;

class EventCategoriesRepository extends EventCategories
{
    public function execute($type)
    {
        $dbObject = new DatabaseAccessObject();

        $sql = '';
        $values = [];

        switch ($type) {
            case 'SELECT_BY':
                $sql = 'SELECT * FROM event_categories WHERE event_id = ? AND is_deleted = false ORDER BY id ASC';
                $values[] = $this->getEventId();

                return $dbObject->run('SELECT', $sql, $values);

            case 'SELECT_CATEGORY_NAME':
                $sql = 'SELECT
                            ec.event_id,
                            c.name AS category_name
                        FROM 
                            event_categories ec
                            LEFT JOIN category c on ec.category_id = c.id
                        WHERE
                            ec.is_deleted = FALSE
                        ORDER BY
                            ec.id';
                return $dbObject->run('SELECT', $sql);
        }
    }
}
