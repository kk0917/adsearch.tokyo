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
                $this->setUrl(htmlentities($_POST['url'], ENT_QUOTES, 'UTF-8'));
                $this->setComment(htmlentities($_POST['comment'], ENT_QUOTES, 'UTF-8'));
                if (array_key_exists('new', $_POST)) {
                    $this->setNew(htmlentities($_POST['new'], ENT_QUOTES, 'UTF-8'));
                }
                if (array_key_exists('popular', $_POST)) {
                    $this->setPopular(htmlentities($_POST['popular'], ENT_QUOTES, 'UTF-8'));
                }
                if (array_key_exists('pickup', $_POST)) {
                    $this->setPickup(htmlentities($_POST['pickup'], ENT_QUOTES, 'UTF-8'));
                }
                $this->setMainImageInfo($_FILES['mainImage']);
                $this->setListImageInfo($_FILES['listImage']);

                $date = new \DateTime();
                $this->setCreatedAt($date->format('Y-m-d H:i:s'));
                $this->setCreatedManagerId(0); // TODO: セッション管理後にcreatedManagerIdの改修
                break;

            case 'UPDATE':
                //
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