<?php

namespace AppBundle\Entity;

class Event
{
    private $id;
    private $eventName;
    private $categoriesId;
    private $dateFrom;
    private $dateTo;
    private $businessTime;
    private $closingDays;
    private $entryFee;
    private $placeId;
    private $url;
    private $comment;
    private $new;
    private $popular;
    private $pickup;
    private $mainImageInfo;
    private $mainImagePath;
    private $listImageInfo;
    private $listImagePath;
    private $isDeleted;
    private $createdAt;
    private $createdManagerId;
    private $updatedAt;
    private $updatedManagerId;

    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
    }

    public function getCategoriesId()
    {
        return $this->categoriesId;
    }
    public function setCategoriesId($categoriesId) {
        $this->categoriesId = $categoriesId;
    }

    public function getEventName()
    {
        return $this->eventName;
    }
    public function setEventName($eventName)
    {
        $this->eventName = $eventName;
    }

    public function getDateFrom()
    {
        return $this->dateFrom;
    }
    public function setDateFrom($dateFrom)
    {
        $this->dateFrom = $dateFrom;
    }

    public function getDateTo()
    {
        return $this->dateTo;
    }
    public function setDateTo($dateTo)
    {
        $this->dateTo = $dateTo;
    }

    public function getBusinessTime()
    {
        return $this->businessTime;
    }
    public function setBusinessTime($businessTime)
    {
        $this->businessTime = $businessTime;
    }

    public function getClosingDays()
    {
        return $this->closingDays;
    }
    public function setClosingDays($closingDays)
    {
        $this->closingDays = $closingDays;
    }

    public function getEntryFee()
    {
        return $this->entryFee;
    }
    public function setEntryFee($entryFee)
    {
        $this->entryFee = $entryFee;
    }

    public function getPlaceId()
    {
        return $this->placeId;
    }
    public function setPlaceId($placeId)
    {
        $this->placeId = $placeId;
    }

    public function getUrl()
    {
        return $this->url;
    }
    public function setUrl($url)
    {
        $this->url = $url;
    }

    public function getComment()
    {
        return $this->comment;
    }
    public function setComment($comment)
    {
        $this->comment = $comment;
    }

    public function getNew()
    {
        return $this->new;
    }
    public function setNew($new)
    {
        $this->new = $new;
    }

    public function getPopular()
    {
        return $this->popular;
    }
    public function setPopular($popular)
    {
        $this->popular = $popular;
    }

    public function getPickup()
    {
        return $this->pickup;
    }
    public function setPickup($pickup)
    {
        $this->pickup = $pickup;
    }

    public function getMainImageInfo()
    {
        return $this->mainImageInfo;
    }
    public function setMainImageInfo($mainImageInfo)
    {
        $this->mainImageInfo = $mainImageInfo;
    }

    public function getMainImagePath()
    {
        return $this->mainImagePath;
    }
    public function setMainImagePath($mainImagePath)
    {
        $this->mainImagePath = $mainImagePath;
    }

    public function getListImageInfo()
    {
        return $this->listImageInfo;
    }
    public function setListImageInfo($listImageInfo)
    {
        $this->listImageInfo = $listImageInfo;
    }

    public function getListImagePath()
    {
        return $this->listImagePath;
    }
    public function setListImagePath($listImagePath)
    {
        $this->listImagePath = $listImagePath;
    }

    public function getIsDeleted()
    {
        return $this->isDeleted;
    }
    public function setIsDeleted($isDeleted)
    {
        $this->isDeleted = $isDeleted;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    public function getCreatedManagerId()
    {
        return $this->createdManagerId;
    }
    public function setCreatedManagerId($createdManagerId)
    {
        $this->createdManagerId = $createdManagerId;
    }

    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    public function getUpdatedManagerId()
    {
        return $this->updatedManagerId;
    }
    public function setUpdatedManagerId($updatedManagerId)
    {
        $this->updatedManagerId = $updatedManagerId;
    }

    /**
     * DB更新時に必要なプロパティに値をセット
     * @param string $type データ操作種別
     */
    public function setProperties($type)
    {
        switch ($type) {
            case 'INSERT':
                $this->setEventName(htmlentities($_POST['eventName'], ENT_QUOTES, 'UTF-8'));
                if (array_key_exists('categoriesId', $_POST)) {
                    // カテゴリーIDを格納した配列をセット
                    $this->setCategoriesId($_POST['categoriesId']);
                }
                $this->setDateFrom(htmlentities($_POST['dateFrom'], ENT_QUOTES, 'UTF-8'));
                $this->setDateTo(htmlentities($_POST['dateTo'], ENT_QUOTES, 'UTF-8'));
                $this->setBusinessTime(htmlentities($_POST['businessTime'], ENT_QUOTES, 'UTF-8'));
                $this->setClosingDays(htmlentities($_POST['closingDays'], ENT_QUOTES, 'UTF-8'));
                $this->setEntryFee(htmlentities($_POST['entryFee'], ENT_QUOTES, 'UTF-8'));
                $this->setPlaceId(htmlentities($_POST['placeId'], ENT_QUOTES, 'UTF-8'));
                if (array_key_exists('url', $_POST)) {
                    $this->setUrl(htmlentities($_POST['url'], ENT_QUOTES, 'UTF-8'));
                }
                if (array_key_exists('comment', $_POST)) {
                    $this->setComment(htmlentities($_POST['comment'], ENT_QUOTES, 'UTF-8'));
                }
                if (array_key_exists('status-new', $_POST)) {
                    $this->setNew(htmlentities($_POST['status-new'], ENT_QUOTES, 'UTF-8'));
                }
                if (array_key_exists('status-popular', $_POST)) {
                    $this->setPopular(htmlentities($_POST['status-popular'], ENT_QUOTES, 'UTF-8'));
                }
                if (array_key_exists('status-pickup', $_POST)) {
                    $this->setPickup(htmlentities($_POST['status-pickup'], ENT_QUOTES, 'UTF-8'));
                }
                // メイン画像
                if ($_FILES['updateMainImage']['name']) { // 画像が選択されている場合
                    // 保存先のパスをセットする
                    $this->setMainImagePath(htmlentities($_FILES['updateMainImage']['tmp_name'], ENT_QUOTES, 'UTF-8'));
                    // 画像情報をセットする
                    $this->setMainImageInfo(json_encode($_FILES['updateMainImage']));
                }
                // リスト画像
                if ($_FILES['updateListImage']['name']) { // 画像が選択されている場合
                    // 保存先のパスをセットする
                    $this->setListImagePath(htmlentities($_FILES['updateListImage']['tmp_name'], ENT_QUOTES, 'UTF-8'));
                    // 画像情報をセットする
                    $this->setListImageInfo(json_encode($_FILES['updateListImage']));
                }

                $date = new \DateTime();
                $this->setCreatedAt($date->format('Y-m-d H:i:s'));
                $this->setCreatedManagerId(1); // TODO: セッション管理後にcreatedManagerIdの改修
                break;

            case 'UPDATE':
                $this->setId(htmlentities($_POST['id']));
                $this->setEventName(htmlentities($_POST['eventName'], ENT_QUOTES, 'UTF-8'));
                if (array_key_exists('categoriesId', $_POST)) {
                    // カテゴリーIDを格納した配列をセット
                    $this->setCategoriesId($_POST['categoriesId']);
                }
                $this->setDateFrom(htmlentities($_POST['dateFrom'], ENT_QUOTES, 'UTF-8'));
                $this->setDateTo(htmlentities($_POST['dateTo'], ENT_QUOTES, 'UTF-8'));
                $this->setBusinessTime(htmlentities($_POST['businessTime'], ENT_QUOTES, 'UTF-8'));
                $this->setClosingDays(htmlentities($_POST['closingDays'], ENT_QUOTES, 'UTF-8'));
                $this->setEntryFee(htmlentities($_POST['entryFee'], ENT_QUOTES, 'UTF-8'));
                $this->setPlaceId(htmlentities($_POST['placeId'], ENT_QUOTES, 'UTF-8'));
                if (array_key_exists('url', $_POST)) {
                    $this->setUrl(htmlentities($_POST['url'], ENT_QUOTES, 'UTF-8'));
                }
                if (array_key_exists('comment', $_POST)) {
                    $this->setComment(htmlentities($_POST['comment'], ENT_QUOTES, 'UTF-8'));
                }
                if (array_key_exists('status-new', $_POST)) {
                    $this->setNew(htmlentities($_POST['status-new'], ENT_QUOTES, 'UTF-8'));
                }
                if (array_key_exists('status-popular', $_POST)) {
                    $this->setPopular(htmlentities($_POST['status-popular'], ENT_QUOTES, 'UTF-8'));
                }
                if (array_key_exists('status-pickup', $_POST)) {
                    $this->setPickup(htmlentities($_POST['status-pickup'], ENT_QUOTES, 'UTF-8'));
                }
                // メイン画像：パス
                if ($_FILES['updateMainImage']['name']) { // 新しい画像がある場合
                    // 保存先のパスをセットする
                    $this->setMainImagePath(htmlentities($_FILES['updateMainImage']['tmp_name'], ENT_QUOTES, 'UTF-8'));

                    // 保存先の画像情報をセットする
                        // デコード時のエラーを回避するためにすべての値を文字列に変換する
                    $_FILES['updateMainImage']['error'] = (string) $_FILES['updateMainImage']['error'];
                    $_FILES['updateMainImage']['size']  = (string) $_FILES['updateMainImage']['size'];
                    $this->setMainImageInfo(json_encode($_FILES['updateMainImage']));

                } elseif ($_POST['mainImagePath']) { // 新しい画像が無く既存の画像があれば再登録する
                    $this->setMainImagePath(htmlentities($_POST['mainImagePath'], ENT_QUOTES, 'UTF-8'));
                }
                // リスト画像：パス
                if ($_FILES['updateListImage']['name']) { // 新しい画像がある場合
                    // 保存先のパスをセットする
                    $this->setListImagePath(htmlentities($_FILES['updateListImage']['tmp_name'], ENT_QUOTES, 'UTF-8'));

                    // 保存先の画像情報をセットする
                        // デコード時のエラーを回避するためにすべての値を文字列に変換する
                    $_FILES['updateListImage']['error'] = (string) $_FILES['updateListImage']['error'];
                    $_FILES['updateListImage']['size']  = (string) $_FILES['updateListImage']['size'];
                    $this->setListImageInfo(json_encode($_FILES['listImageInfo']));

                } elseif ($_POST['listImagePath']) { // 新しい画像が無く既存の画像があれば再登録する
                    $this->setListImagePath(htmlentities($_POST['listImagePath'], ENT_QUOTES, 'UTF-8'));
                }

                $date = new \DateTime();
                $this->setUpdatedAt($date->format('Y-m-d H:i:s'));
                $this->setUpdatedManagerId(1); // TODO: セッション管理後にupdatedManagerIdの改修
                break;
        }
    }

    public function getProperties()
    {
        return $event = [
            'id'               => $this->getId(),
            'eventName'        => $this->getEventName(),
            'categoriesId'     => $this->getCategoriesId(),
            'dateFrom'         => $this->getDateFrom(),
            'dateTo'           => $this->getDateTo(),
            'businessTime'     => $this->getBusinessTime(),
            'closingDays'      => $this->getClosingDays(),
            'entryFee'         => $this->getEntryFee(),
            'placeId'          => $this->getPlaceId(),
            'url'              => $this->getUrl(),
            'comment'          => $this->getComment(),
            'new'              => $this->getNew(),
            'popular'          => $this->getPopular(),
            'pickup'           => $this->getPickup(),
            'mainImageInfo'    => $this->getMainImageInfo(),
            'mainImagePath'    => $this->getMainImagePath(),
            'listImageInfo'    => $this->getListImageInfo(),
            'listImagePath'    => $this->getListImagePath(),
            'isDeleted'        => $this->getIsDeleted(),
            'createdAt'        => $this->getCreatedAt(),
            'createdManagerId' => $this->getCreatedManagerId(),
            'updatedAt'        => $this->getUpdatedAt(),
            'updatedManagerId' => $this->getUpdatedManagerId()
        ];
    }
}

?>
