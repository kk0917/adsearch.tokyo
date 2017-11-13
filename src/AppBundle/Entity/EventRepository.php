<?php
/**
 * Created by PhpStorm.
 * User: kamenashikou
 * Date: 2017/11/12
 * Time: 12:10
 */

namespace AppBundle\Entity;


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
        if ($this->get() == null) {
            $errors[] = 'イベント名を入力してください';
        }

        // 開催日・開催日：日付フォーマットチェック

        // 開催場所：必須チェック

        // メイン画像：容量チェック

        // メイン画像：幅・高さチェック

        // リスト画像：容量チェック

        // リスト画像：幅・高さチェック

        return $errors;
    }
}