<?php
/**
 * Created by PhpStorm.
 * User: kamenashikou
 * Date: 2017/11/06
 * Time: 18:29
 */

namespace AppBundle\Common;

use AppBundle\Common\Config;

/**
 * Class DatabaseAccessObject データベースへの接続、リクエストを管理
 */
class DatabaseAccessObject
{
    /**
     * @var \PDO $dbh データベースハンドラ
     */
    private $dbh;

    /**
     * データベースへ接続する
     *
     * @throws \PDOException
     */
    public function __construct()
    {
        // データベース情報
        $dbInfo   = yaml_parse_file($_SERVER['DOCUMENT_ROOT'] . '/app/config/config.yml');
        $dsn      = $dbInfo['database']['dsn'];
        $user     = $dbInfo['database']['user'];
        $password = $dbInfo['database']['password']; // 会社テスト環境用

        // DB接続とエラー発生時のエラーモード設定
        $this->dbh = new \PDO($dsn, $user, $password);
        $this->dbh->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    /**
     * セットしたクエリを実行する
     *
     * @paramsh array $params
     * @return array $stmt
     * @throws \PDOException
     */
    public function run($type, $query, $params = [])
    {
        $this->dbh->beginTransaction();

        try {
            $stmt = $this->dbh->prepare($query);

            if (count($params)) {
                $stmt->execute($params);

            } else {
                $stmt->execute();
            }


        } catch (\Exception $e) {
            // トランザクションが失敗した際のロールバック処理
            $this->dbh->rollBack();
            throw $e;
        }

        $lastInsertId = $this->dbh->lastInsertId();

        $this->dbh->commit();

        switch ($type) {
            case 'SELECT':
            case 'SELECT_ALL':
                return $stmt->fetchAll();
                break;

            case 'FIND':
            case 'SELECT_BY_ONE':
                return $stmt->fetch();

            case 'INSERT':
                return $lastInsertId;
                break;

            case 'UPDATE':
                break; // 何もしない

            case 'DELETE':
                break; // 何もしない
        }
    }

    /**
     * 接続を閉じる
     */
    public function __destruct()
    {
        $this->dbh = null;
    }
}
