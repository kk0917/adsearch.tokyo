<?php
/**
 * Created by PhpStorm.
 * User: kamenashikou
 * Date: 2017/11/06
 * Time: 17:54
 */

namespace AppBundle\Entity;

use AppBundle\Common\DatabaseAccessObject;


class ManagerRepository extends Manager
{
    /**
     * DB更新時に必要なすべてのプロパティに値をセット
     *
     * @param string  $type    INSERT or UPDATE
     * @param Manager $manager Managerオブジェクト
     */
    public function setAllProperties($type)
    {
        if (count($_POST)) {
            $this->setUsername(htmlentities($_POST['user_name'], ENT_QUOTES, 'UTF-8'));
            $this->setPassword(htmlentities($_POST['password'], ENT_QUOTES, 'UTF-8'));
            if (array_key_exists('password_confirm', $_POST)) {
                $this->setPasswordConfirm((htmlentities($_POST['password_confirm'], ENT_QUOTES, 'UTF-8')));
            }
            $this->setLastName(htmlentities($_POST['last_name'], ENT_QUOTES, 'UTF-8'));
            $this->setFirstName(htmlentities($_POST['first_name'], ENT_QUOTES, 'UTF-8'));
            $this->setRemarks(htmlentities($_POST['remarks'], ENT_QUOTES, 'UTF-8'));

            $date = new \DateTime();
            if ($type == 'INSERT') {
                $this->setCreatedAt($date->format('Y-m-d H:i:s'));

            } elseif ($type == 'UPDATE') {
                $this->setUpdatedAt($date->format('Y-m-d H:i:s'));
            }
        }
    }
    /**
     * 管理者登録用バリデーション
     *
     * @return array $error
     */
    public function validate()
    {
        $error = [];

        // username：入力必須チェック
        if ($this->getUsername() == null) {
            $error[] = 'ユーザー名を入力してください';
        } else {
            // username：文字種別チェック
            if (preg_match('/^[a-zA-Z0-9]+$/', $this->getUsername()) !== 1) {
                $error[] = 'ユーザー名は英数字のみ使用可能です';
            }

            // username：既に使われているユーザー名かどうかチェック
            $sql = 'SELECT user_name FROM manager';
            $dbObject = new DatabaseAccessObject();
            $results = $dbObject->run('SELECT', $sql);

            if (count($results)) {
                foreach ($results as $result) {
                    if ($this->getUsername() == $result['user_name']) {
                        $error[] = 'このユーザー名は既に使われています';
                    }
                }
            }
        }

        // password：入力必須チェック
        if ($this->getPassword() == null) {
            $error[] = 'パスワードを入力してください';
        } else {
            // パスワード確認用同一チェック
            if ($this->getPassword() != $this->getPasswordConfirm()) {
                $error[] = 'パスワードが一致しません';
            }

            // password：文字種別＆文字数チェック
            if (preg_match('/^[a-zA-Z0-9]{8,}$/', $this->getPassword()) !== 1) {
                $error[] = 'パスワードは英数字のみ８文字以上で作成してください';
            }
        }

        return $error;
    }

    public function execute($type)
    {
        $dbObject = new DatabaseAccessObject();

        $sql = '';
        $values = [];

        switch ($type) {
            case 'SELECT':
                $sql = 'SELECT * FROM manager WHERE is_active = TRUE ORDER BY id';

                return $dbObject->run('SELECT', $sql);
                break;

            case 'INSERT':
                $sql = 'INSERT INTO `manager` (
                          `user_name`,
                          `password`,
                          `password_updated_at`,
                          `last_name`,
                          `first_name`,
                          `remarks`,
                          `is_active`,
                          `is_locked`,
                          `authentication_failure_count`,
                          `created_at`,
                          `updated_at`,
                          `updated_manager_id`
                        ) VALUES (
                          ?,
                          ?,
                          NULL,
                          ?,
                          ?,
                          ?,
                          1,
                          0,
                          NULL,
                          ?,
                          NULL,
                          NULL
                      )';

                $values = [
                    $this->getUsername(),
                    $this->getPassword(),
                    $this->getLastName(),
                    $this->getFirstName(),
                    $this->getRemarks(),
                    $this->getCreatedAt(),
                ];

                $dbObject->run('INSERT', $sql, $values);
                break;

            case 'DELETE':
                $sql = 'UPDATE manager SET is_active = FALSE WHERE id = ?';

                $value = [
                    $this->getId()
                ];

                $dbObject->run('DELETE', $sql, $value);
        }
    }
}