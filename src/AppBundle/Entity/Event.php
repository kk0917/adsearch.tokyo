<?php

namespace AppBundle\Entity;

class Event
{
    private $id;
    private $eventName;
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
    private $mainImagePath;
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

    public function getEventName()
    {
        return $this->eventName;
    }
    public function setEventTime($eventName)
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

    public function getMainImagePath()
    {
        return $this->mainImagePath;
    }
    public function setMainImagepath($mainImagePath)
    {
        $this->mainImagePath = $mainImagePath;
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
}

?>