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
     * 管理者登録用バリデーション
     *
     * @param string $type  クエリタイプ：追加（INSERT） or 編集（UPDATE）
     * @return array $error 該当エラーメッセージ格納配列
     */
    public function validate($type)
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

            // 追加時のチェック
            if ($type == 'INSERT') {
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
            case 'SELECT_BY_ONE':
                $sql = 'SELECT * FROM manager WHERE id = ?';
                $value = [
                    $this->getId()
                ];

                return $dbObject->run('SELECT_BY_ONE', $sql, $value);
                break;

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

            case 'UPDATE':
                $sql = 'UPDATE manager SET
                          user_name = ?,
                          password = ?,
                          password_updated_at = ?,
                          last_name = ?,
                          first_name = ?,
                          remarks = ?,
                          updated_at = ?,
                          updated_manager_id = 0 WHERE id = ?';

                $values = [
                    $this->getUsername(),
                    $this->getPassword(),
                    $this->getPasswordUpdatedAt(),
                    $this->getLastName(),
                    $this->getFirstName(),
                    $this->getRemarks(),
                    $this->getUpdatedAt(),
                    $this->getId(),
                ];

                $dbObject->run('UPDATE', $sql, $values);
                break;

            case 'DELETE':
                $sql = 'UPDATE manager SET is_active = FALSE WHERE id = ?';

                $value = [
                    $this->getId()
                ];

                $dbObject->run('DELETE', $sql, $value);
                break;
        }
    }
}