<?php
/**
 * Created by PhpStorm.
 * User: kamenashikou
 * Date: 2017/11/12
 * Time: 12:10
 */

namespace AppBundle\Entity;

use AppBundle\Common\DatabaseAccessObject;

class EventRepository extends Event
{
    /**
     * イベント登録用バリデーション
     *
     * @return array $errors 発生したエラー警告メッセージ配列
     */
    public function validate()
    {
        $errors = [];

        // イベント名：必須チェック
        if ($this->getEventName() == null) {
            $errors[] = 'イベント名を入力してください';
        }

        // カテゴリー：必須チェック
        if (!$this->getCategoriesId()) {
            $errors[] = 'カテゴリーを選択してください';
        }

        // 開催日：必須チェック
        if ($this->getDateFrom() == null) {
            $errors[] = '開催日を指定してください';
        } else {
            // 開催日：日付フォーマットチェック
            if (preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/', $this->getDateFrom())  == false) {
                $errors[] = '開催日は YY-MM-DD の形式で入力してください';
            }
        }

        // 最終日：必須チェック
        if ($this->getDateTo() == null) {
            $errors[] = '最終日を指定してください';
        } else {
            // 最終日：日付フォーマットチェック
            if (preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/', $this->getDateTo())  == false) {
                $errors[] = '最終日は YY-MM-DD の形式で入力してください';
            }
        }

        if ($this->getDateTo() < $this->getDateFrom()) {
            $errors[] = '最終日は開催日より後の日付を指定してください';
        }

        // 入場料：必須チェック
        if ($this->getEntryFee() == null) {
            $errors[] = '入場料を入力してください';
        }

        // 営業時間：必須チェック
        if ($this->getBusinessTime() == null) {
            $errors[] = '営業時間を入力してください';
        }

        // 休館日：必須チェック
        if ($this->getClosingDays() == null) {
            $errors[] = '休館日を入力してください';
        }

        // 開催場所：必須チェック
        if ($this->getPlaceId() == null) {
            $errors[] = '開催場所を選択してください';
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

                // メイン画像：幅・高さチェック
                $imageSize   = getimagesize($mainImageInfo['tmp_name']);
                $imageWidth  = $imageSize[0];
                $imageHeight = $imageSize[1];

                if ($imageWidth  != 870) $errors[] = 'メイン画像の幅は870pxにしてください';
                if ($imageHeight != 580) $errors[] = 'メイン画像の高さは580pxにしてください';
            }
        } else {
            $errors[] = 'メイン画像を選択してください';
        }

        $listImageInfo = $this->getListImageInfo();
        if (is_array($listImageInfo)) {
            if ($listImageInfo['size'] >= 20000000) {
                $errors[] = 'リスト画像の容量は2M未満にしてください';
            }

            // リスト画像：幅・高さチェック
            $imageSize   = getimagesize($listImageInfo['tmp_name']);
            $imageWidth  = $imageSize[0];
            $imageHeight = $imageSize[1];

            if ($imageWidth  != 870) $errors[] = 'リスト画像の幅は870pxにしてください';
            if ($imageHeight != 580) $errors[] = 'リスト画像の高さは580pxにしてください';
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

        // リスト画像の処理
        $listImageInfo = json_decode($this->getListImageInfo(), true);
        if ($listImageInfo['name']) {
            $listImageName = $date->format('YmdHis') . rand(1000, 9999) . $listImageInfo['name'];
            move_uploaded_file($listImageInfo['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . $imagePath . $listImageName);
            $this->setListImagePath($imagePath . $listImageName);
        }
    }

    public function execute($type)
    {
        $dbObject = new DatabaseAccessObject();

        $sql = '';
        $values = [];

        switch ($type) {
            case 'SELECT_UPCOMING':
                $sql = 'SELECT * FROM event WHERE is_deleted = FALSE AND date_to >= NOW() ORDER BY date_from ASC';

                return $dbObject->run('SELECT', $sql);
                break;

            case 'SELECT_PAST':
                $sql = 'SELECT * FROM event WHERE is_deleted = FALSE AND date_to < NOW() ORDER BY date_to DESC';

                return $dbObject->run('SELECT', $sql);
                break;

            case 'SELECT_ONE_BY':
                $sql = 'SELECT * FROM event WHERE id = ? AND is_deleted = false';
                $value = [
                    $this->getId()
                ];

                return $dbObject->run('SELECT_BY_ONE', $sql, $value);
                break;

            case 'INSERT':
                $sql = 'INSERT INTO event (
                         event_name,
                         date_from,
                         date_to,
                         business_time,
                         closing_days,
                         entry_fee,
                         place_id,
                         url,
                         comment,
                         new,
                         popular,
                         pickup,
                         main_image_path,
                         list_image_path,
                         created_at,
                         created_manager_id
                       ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';

                $new     = $this->getNew() ? 1 : 0;
                $popular = $this->getPopular() ? 1 : 0;
                $pickup  = $this->getPickup() ? 1 : 0;

                $values = [
                    $this->getEventName(),
                    $this->getDateFrom(),
                    $this->getDateTo(),
                    $this->getBusinessTime(),
                    $this->getClosingDays(),
                    $this->getEntryFee(),
                    $this->getPlaceId(),
                    $this->getUrl(),
                    $this->getComment(),
                    $new,
                    $popular,
                    $pickup,
                    $this->getMainImagePath(),
                    $this->getListImagePath(),
                    $this->getCreatedAt(),
                    $this->getCreatedManagerId()
                ];

                $eventId      = $dbObject->run('INSERT', $sql, $values);
                $categoriesId = $this->getCategoriesId();

                if (count($categoriesId)) {
                    foreach ($categoriesId as $categoryId) {
                        $sql = 'INSERT INTO event_categories (
                                 event_id,
                                 category_id,
                                 created_at,
                                 created_manager_id
                               ) VALUES (?, ?, ?, ?)';

                        $values = [
                            $eventId,
                            $categoryId,
                            $this->getCreatedAt(),
                            $this->getCreatedManagerId()
                        ];

                        $dbObject->run('INSERT', $sql, $values);
                    }
                }
                return $eventId;

            case 'UPDATE':
                $sql = 'UPDATE
                            event
                        SET
                            event_name = ?,
                            date_from = ?,
                            date_to = ?,
                            business_time = ?,
                            closing_days = ?,
                            entry_fee = ?,
                            place_id = ?,
                            url = ?,
                            comment = ?,
                            new = ?,
                            popular = ?,
                            pickup = ?,
                            main_image_path = ?,
                            list_image_path = ?,
                            updated_at = ?,
                            updated_manager_id = ?
                        WHERE
                            id = ?';

                $new     = $this->getNew() ? 1 : 0;
                $popular = $this->getPopular() ? 1 : 0;
                $pickup  = $this->getPickup() ? 1 : 0;

                $values = [
                    $this->getEventName(),
                    $this->getDateFrom(),
                    $this->getDateTo(),
                    $this->getBusinessTime(),
                    $this->getClosingDays(),
                    $this->getEntryFee(),
                    $this->getPlaceId(),
                    $this->getUrl(),
                    $this->getComment(),
                    $new,
                    $popular,
                    $pickup,
                    $this->getMainImagePath(),
                    $this->getListImagePath(),
                    $this->getUpdatedAt(),
                    $this->getUpdatedManagerId(),
                    $this->getId()
                ];

                $dbObject->run('UPDATE', $sql, $values);
                $categoriesId = $this->getCategoriesId();

                $sql = 'UPDATE event_categories SET is_deleted = TRUE, updated_at = now(), updated_manager_id = 1 WHERE event_id = ?';
                $value = [$this->getId()];
                $dbObject->run('DELETE', $sql, $value);

                if (count($categoriesId)) {
                    foreach ($categoriesId as $categoryId) {
                        $sql = 'INSERT INTO event_categories (
                                 event_id,
                                 category_id,
                                 created_at,
                                 created_manager_id
                               ) VALUES (?, ?, ?, ?)';

                        $values = [
                            $this->getId(),
                            $categoryId,
                            $this->getUpdatedAt(),
                            $this->getUpdatedManagerId()
                        ];

                        $dbObject->run('INSERT', $sql, $values);
                    }
                }
                break;

            case 'DELETE':
                $sql = 'UPDATE event SET is_deleted = TRUE, updated_at = now(), updated_manager_id = 1 WHERE id = ?';

                $value = [
                    $this->getId()
                ];

                $dbObject->run('DELETE', $sql, $value);
                break;
        }
    }
}
