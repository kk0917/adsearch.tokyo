<?php
/**
 * Created by PhpStorm.
 * User: kkkk
 * Date: 2017/11/13
 * Time: 22:29
 */

namespace AppBundle\Entity;

use AppBundle\Common\DatabaseAccessObject;

class PlaceRepository extends Place
{
    /**
     * 会場追加用バリデーション
     *
     * @return array $errors 発生したエラー警告メッセージ配列
     */
    public function validate()
    {
        $errors = [];

        // 会場名：必須チェック
        if ($this->getName() == null) {
            $errors[] = '会場名を入力してください';
        }

        // 郵便番号：必須チェック
        if ($this->getZipCode1() == null || $this->getZipCode2() == null) {
            $errors[] = '郵便番号を入力してください';
        }
        // 郵便番号：桁数チェック
        if (strlen($this->getZipCode1()) > 3 || strlen($this->getZipCode2()) > 4) {
            $errors[] = '郵便番号の桁数が正しくありません';
        }
        // 住所（都道府県名）：必須チェック
        if ($this->getPrefecture() == null) {
            $errors[] = '都道府県名を選択してください';
        }
        // 住所（市区郡（町村））：必須チェック
        if ($this->getAddress1() == null) {
            $errors[] = '市区郡（町村）を入力してください';
        }
        // 住所（町村名）：必須チェック
        if ($this->getAddress2() == null) {
            $errors[] = '町村名を入力してください';
        }
        // 住所（丁目 − 番地 − 号）：必須チェック
        if ($this->getAddress3() == null) {
            $errors[] = '丁目 − 番地 − 号を入力してください';
        }

        // 電話番号：必須チェック
        if ($this->getPhone() == null) {
            $errors[] = '電話番号を入力してください';
        }

        // 営業日：必須チェック
        if ($this->getBusinessDays() == null) {
            $errors[] = '営業日を入力してください';
        }

        // 休館日：必須チェック
        if ($this->getClosingDays() == null) {
            $errors[] = '休館日を入力してください';
        }

        // 画像のバリデーション
            // メイン画像：必須チェック
        $mainImageInfo = json_decode($this->getMainImageInfo(), true);
        if (is_array($mainImageInfo)) {
            if ($mainImageInfo['name'] == null) {
                $errors[] = 'メイン画像を選択してください';
            } else {
                // メイン画像：容量チェック
                if ($mainImageInfo['size'] >= 20000000) {
                    $errors[] = 'メイン画像の容量は2M未満にしてください';
                }
                // TODO: メイン画像：幅・高さチェック
                // getimagesize($_SERVER['DOCUMENT_ROOT'] . '/web/uploads/' . $_FILES['mainImagePath']['name']);
            }
        } else {
            $errors[] = 'メイン画像を選択してください';
        }
            // サブ画像：容量チェック
        $subImageInfo = $this->getSubImageInfo();
        if (is_array($subImageInfo)) {
            if ($subImageInfo['size'] >= 20000000) {
                $errors[] = 'リスト画像の容量は2M未満にしてください';
            }
            // TODO: サブ画像：幅・高さチェック
            // getimagesize($_SERVER['DOCUMENT_ROOT'] . '/web/uploads/' . $_FILES['subImagePath']['name']);
        }

        return $errors;
    }

    /**
     * 画像を決められた場所にアップロードする
     * @param array $image 画像情報
     */
    public function checkUploadImage()
    {
        $imagePath = '/web/uploads/';
        $date      = new \DateTime();

        // メイン画像の処理
        $mainImageInfo = json_decode($this->getMainImageInfo(), true);
        if ($mainImageInfo['name']) {
            $mainImageName = $date->format('YmdHis') . rand(1000, 9999) . $mainImageInfo['name'];
            move_uploaded_file($mainImageInfo['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . $imagePath . $mainImageName);
            $this->setMainImagePath($imagePath . $mainImageName);
        }

        // サブ画像の処理
        $subImageInfo = json_decode($this->getSubImageInfo(), true);
        if ($subImageInfo['name']) {
            $subImageName = $date->format('YmdHis') . rand(1000, 9999) . $subImageInfo['name'];
            move_uploaded_file($subImageInfo['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . $imagePath . $subImageName);
            $this->setSubImagePath($imagePath . $subImageName);
        }
    }

    /**
     * クエリ実行
     * @param  string $type クエリ実行タイプ(INSERT/SELECT/UPDATE/DELETE)
     * @return        SELECT系は結果レコード、INSERT, UPDATE系は実行レコード行idを返す
     */
    public function execute($type)
    {
        $dbObject = new DatabaseAccessObject();

        $sql = '';
        $values = [];

        switch ($type) {
            case 'SELECT_ALL':
                $sql = 'SELECT * FROM place WHERE is_deleted = FALSE ORDER BY id';

                return $dbObject->run('SELECT_ALL', $sql);

            case 'FIND':
                $sql = 'SELECT * FROM place WHERE id = ? AND is_deleted = FALSE';
                $value = [
                    $this->getId()
                ];
                return $dbObject->run('FIND', $sql, $value);

            case 'INSERT':
                $sql = 'INSERT INTO place (
                         name,
                         zip_code1,
                         zip_code2,
                         prefecture,
                         address1,
                         address2,
                         address3,
                         address4,
                         access_information,
                         phone,
                         business_days,
                         closing_days,
                         url,
                         main_image_path,
                         main_image_info,
                         sub_image_path,
                         sub_image_info,
                         comment,
                         created_at,
                         created_manager_id
                     ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';

                $values = [
                    $this->getName(),
                    $this->getZipCode1(),
                    $this->getZipCode2(),
                    $this->getPrefecture(),
                    $this->getAddress1(),
                    $this->getAddress2(),
                    $this->getAddress3(),
                    $this->getAddress4(),
                    $this->getAccessInformation(),
                    $this->getPhone(),
                    $this->getBusinessDays(),
                    $this->getClosingDays(),
                    $this->getUrl(),
                    $this->getMainImagePath(),
                    $this->getMainImageInfo(),
                    $this->getSubImagePath(),
                    $this->getSubImageInfo(),
                    $this->getComment(),
                    $this->getCreatedAt(),
                    $this->getCreatedManagerId()
                ];

                $placeId = $dbObject->run('INSERT', $sql, $values);

                return $placeId;

            case 'UPDATE':
                $sql = 'UPDATE
                            place
                        SET
                            name = ?,
                            zip_code1 = ?,
                            zip_code2 = ?,
                            prefecture = ?,
                            address1 = ?,
                            address2 = ?,
                            address3 = ?,
                            address4 = ?,
                            access_information = ?,
                            phone = ?,
                            business_days = ?,
                            closing_days = ?,
                            url = ?,
                            main_image_path = ?,
                            main_image_info = ?,
                            sub_image_path = ?,
                            sub_image_info = ?,
                            comment = ?,
                            updated_at = ?,
                            updated_manager_id = ?
                        WHERE
                            id = ?';
                $values = [
                    $this->getName(),
                    $this->getZipCode1(),
                    $this->getZipCode2(),
                    $this->getPrefecture(),
                    $this->getAddress1(),
                    $this->getAddress2(),
                    $this->getAddress3(),
                    $this->getAddress4(),
                    $this->getAccessInformation(),
                    $this->getPhone(),
                    $this->getBusinessDays(),
                    $this->getClosingDays(),
                    $this->getUrl(),
                    $this->getMainImagePath(),
                    $this->getMainImageInfo(),
                    $this->getSubImagePath(),
                    $this->getSubImageInfo(),
                    $this->getComment(),
                    $this->getUpdatedAt(),
                    $this->getUpdatedManagerId(),
                    $this->getId()
                ];
                $dbObject->run('UPDATE', $sql, $values);
                break;

            case 'DELETE':
                $sql = 'UPDATE place SET is_deleted = TRUE, updated_at = now(), updated_manager_id = 1 WHERE id = ?'; // TODO: updated_manager_idを改修

                $value = [
                    $this->getId()
                ];

                $dbObject->run('DELETE', $sql, $value);
                break;
        }
    }
}
