<?php
/**
 * Created by PhpStorm.
 * User: kkkk
 * Date: 2017/11/16
 * Time: 13:21
 */

namespace AppBundle\Entity;


class EventCategories
{
    private $id;
    private $eventId;
    private $categoryId;
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

    public function getEventId()
    {
        return $this->eventId;
    }
    public function setEventId($eventId)
    {
        $this->eventId = $eventId;
    }

    public function getCategoryId()
    {
        return $this->categoryId;
    }
    public function setCategoryId($categoryId)
    {
        $this->categoryId = $categoryId;
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

    public function getProperties()
    {
        return $eventCategories = [
            'id'               => $this->id,
            'eventId'          => $this->eventId,
            'categoryId'       => $this->categoryId,
            'isDeleted'        => $this->isDeleted,
            'createdAt'        => $this->createdAt,
            'createdManagerId' => $this->createdManagerId,
            'updatedAt'        => $this->updatedAt,
            'updatedManagerId' => $this->updatedManagerId
        ];
    }
}