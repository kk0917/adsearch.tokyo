<?php
/**
 * Created by PhpStorm.
 * User: kkkk
 * Date: 2017/11/13
 * Time: 20:14
 */

namespace AppBundle\Entity;


class Category
{
    private $id;
    private $name;
    private $isDeleted;
    private $createdAt;
    private $createdManagerId;
    private $updatedAt;
    private $updatedManagerId;

    public function getId()
    {
        return $this->id;
    }
    public function setId($id) {
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }
    public function setName($name) {
        $this->name = $name;
    }

    public function getIsDeleted()
    {
        return $this->isDeleted;
    }
    public function setIsDeleted($isDeleted) {
        $this->isDeleted = $isDeleted;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }
    public function setCreatedAt($createdAt) {
        $this->createdAt = $createdAt;
    }

    public function getCreatedManagerId()
    {
        return $this->createdManagerId;
    }
    public function setCreatedManagerId($createdManagerId) {
        $this->createdManagerId = $createdManagerId;
    }

    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
    public function setUpdatedAt($updatedAt) {
        $this->updatedAt = $updatedAt;
    }

    public function getUpdatedManagerId()
    {
        return $this->updatedManagerId;
    }
    public function setUpdatedManagerId($updatedManagerId) {
        $this->updatedManagerId = $updatedManagerId;
    }
}