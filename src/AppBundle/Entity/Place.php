<?php
/**
 * Created by PhpStorm.
 * User: kkkk
 * Date: 2017/11/13
 * Time: 21:10
 */

namespace AppBundle\Entity;


class Place
{
    private $id;
    private $name;
    private $zipCode;
    private $prefecture;
    private $address1;
    private $address2;
    private $address3;
    private $address4;
    private $accessInformation;
    private $phone;
    private $businessDays;
    private $closingDays;
    private $url;
    private $mainImagePath;
    private $subImagePath;
    private $comment;
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

    public function getZipCode()
    {
        return $this->zipCode;
    }
    public function setZipCode($zipCode) {
        $this->zipCode = $zipCode;
    }

    public function getPrefecture()
    {
        return $this->prefecture;
    }
    public function setPrefecture($prefecture) {
        $this->prefecture = $prefecture;
    }

    public function getAddress1()
    {
        return $this->address1;
    }
    public function setAddress1($address1) {
        $this->address1 = $address1;
    }

    public function getAddress2()
    {
        return $this->address2;
    }
    public function setAddress2($address2) {
        $this->address2 = $address2;
    }

    public function getAddress3()
    {
        return $this->address3;
    }
    public function setAddress3($address3) {
        $this->address3 = $address3;
    }

    public function getAddress4()
    {
        return $this->address4;
    }
    public function setAddress4($address4) {
        $this->address4 = $address4;
    }

    public function getAccessInformation()
    {
        return $this->accessInformation;
    }
    public function setAccessInformation($accessInformation) {
        $this->accessInformation = $accessInformation;
    }

    public function getPhone()
    {
        return $this->phone;
    }
    public function setPhone($phone) {
        $this->phone = $phone;
    }

    public function getBusinessDays()
    {
        return $this->businessDays;
    }
    public function setBusinessDays($businessDays) {
        $this->businessDays = $businessDays;
    }

    public function getClosingDays()
    {
        return $this->closingDays;
    }
    public function setClosingDays($closingDays) {
        $this->closingDays = $closingDays;
    }

    public function getUrl()
    {
        return $this->url;
    }
    public function setUrl($url) {
        $this->url = $url;
    }

    public function getMainImagePath()
    {
        return $this->mainImagePath;
    }
    public function setMainImagePath($mainImagePath) {
        $this->mainImagePath = $mainImagePath;
    }

    public function getSubImagePath()
    {
        return $this->subImagePath;
    }
    public function setSubImagePath($subImagePath) {
        $this->subImagePath = $subImagePath;
    }

    public function getComment()
    {
        return $this->comment;
    }
    public function setComment($comment) {
        $this->comment = $comment;
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