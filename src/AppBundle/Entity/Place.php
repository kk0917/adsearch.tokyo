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
    private $zipCode1;
    private $zipCode2;
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
    private $mainImageInfo;
    private $subImagePath;
    private $subImageInfo;
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

    public function getZipCode1()
    {
        return $this->zipCode1;
    }
    public function setZipCode1($zipCode1) {
        $this->zipCode1 = $zipCode1;
    }

    public function getZipCode2()
    {
        return $this->zipCode2;
    }
    public function setZipCode2($zipCode2) {
        $this->zipCode2 = $zipCode2;
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

    public function getMainImageInfo()
    {
        return $this->mainImageInfo;
    }
    public function setMainImageInfo($mainImageInfo) {
        $this->mainImageInfo = $mainImageInfo;
    }

    public function getSubImagePath()
    {
        return $this->subImagePath;
    }
    public function setSubImagePath($subImagePath) {
        $this->subImagePath = $subImagePath;
    }

    public function getSubImageInfo()
    {
        return $this->subImageInfo;
    }
    public function setSubImageInfo($subImageInfo) {
        $this->subImageInfo = $subImageInfo;
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
                $this->setName(htmlentities($_POST['name'], ENT_QUOTES, 'UTF-8'));
                $this->setZipCode1(htmlentities($_POST['zip-code1'], ENT_QUOTES, 'UTF-8'));
                $this->setZipCode2(htmlentities($_POST['zip-code2'], ENT_QUOTES, 'UTF-8'));
                $this->setPrefecture(htmlentities($_POST['prefecture'], ENT_QUOTES, 'UTF-8'));
                $this->setAddress1(htmlentities($_POST['address1'], ENT_QUOTES, 'UTF-8'));
                $this->setAddress2(htmlentities($_POST['address2'], ENT_QUOTES, 'UTF-8'));
                $this->setAddress3(htmlentities($_POST['address3'], ENT_QUOTES, 'UTF-8'));
                $this->setAddress4(htmlentities($_POST['address4'], ENT_QUOTES, 'UTF-8'));
                $this->setAccessInformation(htmlentities($_POST['access-information'], ENT_QUOTES, 'UTF-8'));
                $this->setPhone(htmlentities($_POST['phone'], ENT_QUOTES, 'UTF-8'));
                $this->setBusinessDays(htmlentities($_POST['business-days'], ENT_QUOTES, 'UTF-8'));
                $this->setClosingDays(htmlentities($_POST['closing-days'], ENT_QUOTES, 'UTF-8'));
                $this->setUrl(htmlentities($_POST['url'], ENT_QUOTES, 'UTF-8'));
                // メイン画像
                if ($_FILES['updateMainImage']['name']) { // 画像が選択されている場合
                    // 保存先のパスをセットする
                    $this->setMainImagePath(htmlentities($_FILES['updateMainImage']['tmp_name'], ENT_QUOTES, 'UTF-8'));
                    // 画像情報をセットする
                    $this->setMainImageInfo(json_encode($_FILES['updateMainImage']));
                }
                // サブ画像
                if ($_FILES['updateSubImage']['name']) { // 画像が選択されている場合
                    // 保存先のパスをセットする
                    $this->setSubImagePath(htmlentities($_FILES['updateSubImage']['tmp_name'], ENT_QUOTES, 'UTF-8'));
                    // 画像情報をセットする
                    $this->setSubImageInfo(json_encode($_FILES['updateSubImage']));
                }
                $this->setComment(htmlentities($_POST['comment'], ENT_QUOTES, 'UTF-8'));

                $date = new \DateTime();
                $this->setCreatedAt($date->format('Y-m-d H:i:s'));
                $this->setCreatedManagerId(1); // TODO: セッション管理後にcreatedManagerIdの改修
                break;
        }
    }

    public function getProperties()
    {
        return $place = [
            'id'               => $this->getId(),
            'name'             => $this->getName(),
            'zipCode1'         => $this->getZipCode1(),
            'zipCode2'         => $this->getZipCode2(),
            'prefecture'       => $this->getPrefecture(),
            'address1'         => $this->getAddress1(),
            'address2'         => $this->getAddress2(),
            'address3'         => $this->getAddress3(),
            'address4'         => $this->getAddress4(),
            'acccessInformation' => $this->getAccessInformation(),
            'phone'              => $this->getPhone(),
            'businessDays'       => $this->getBusinessDays(),
            'closingDays'        => $this->getClosingDays(),
            'url'                => $this->getUrl(),
            'mainImagePath'    => $this->getMainImagePath(),
            'mainImageInfo'    => $this->getMainImageInfo(),
            'subImagePath'     => $this->getSubImagePath(),
            'subImageInfo'     => $this->getSubImageInfo(),
            'comment'          => $this->getComment(),
            'isDeleted'        => $this->getIsDeleted(),
            'createdAt'        => $this->getCreatedAt(),
            'createdManagerId' => $this->getCreatedManagerId(),
            'updatedAt'        => $this->getUpdatedAt(),
            'updatedManagerId' => $this->getUpdatedManagerId()
        ];
    }
}
