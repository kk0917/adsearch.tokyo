<?php
/**
 * Created by PhpStorm.
 * User: kkkk
 * Date: 2017/11/13
 * Time: 20:24
 */

namespace AppBundle\Entity;

use AppBundle\Common\DatabaseAccessObject;


class CategoryRepository extends Category
{
    /**
     * カテゴリ追加用バリデーション
     *
     * @return array $errors 発生したエラー警告メッセージ配列
     */
    public function validate()
    {
        $errors = [];

        // カテゴリ名：必須チェック
        if ($this->getName() == null) {
            $errors[] = 'カテゴリ名を入力してください';
        }

        return $errors;
    }

    public function execute($type)
    {
        $dbObject = new DatabaseAccessObject();

        $sql = '';
        $values = [];

        switch ($type) {
            case 'SELECT_ALL':
                $sql = 'SELECT * FROM category WHERE is_deleted = FALSE ORDER BY id';
                return $dbObject->run('SELECT_ALL', $sql);

            case 'INSERT':
                $sql = 'INSERT INTO category (
                         name,
                         created_at,
                         created_manager_id
                     ) VALUES (?, ?, ?)';

                $values = [
                    $this->getName(),
                    $this->getCreatedAt(),
                    $this->getCreatedManagerId()
                ];

                $categoryId = $dbObject->run('INSERT', $sql, $values);
                return $categoryId;

            case 'UPDATE':
                $sql = 'UPDATE
                            category
                        SET
                            name = ?,
                            updated_at = ?,
                            updated_manager_id = ?
                        WHERE
                            id = ?';

                $values = [
                    $this->getName(),
                    $this->getUpdatedAt(),
                    $this->getUpdatedManagerId(),
                    $this->getId()
                ];

                $dbObject->run('UPDATE', $sql, $values);
                break;

            case 'DELETE':
                $sql = 'UPDATE category SET is_deleted = TRUE, updated_at = now(), updated_manager_id = 1 WHERE id = ?'; // TODO: updated_manager_idを改修

                $value = [
                    $this->getId()
                ];

                $dbObject->run('DELETE', $sql, $value);
                break;
        }
    }
}
