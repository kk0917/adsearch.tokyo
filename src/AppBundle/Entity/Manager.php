<?php
/**
 * Created by PhpStorm.
 * User: kamenashikou
 * Date: 2017/11/06
 * Time: 17:11
 */

namespace AppBundle\Entity;


class Manager
{
    private $id;
    private $username;
    private $password;
    private $passwordConfirm;
    private $passwordUpdatedAt;
    private $lastName;
    private $firstName;
    private $remarks;
    private $isActive;
    private $isLocked;
    private $authentication_failure_count;
    private $createdAt;
    private $updatedAt;
    private $updatedManagerId;

    public function getId()
    {
        return $this->id;
    }

    public function getUsername()
    {
        return $this->username;
    }
    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getPassword()
    {
        return $this->password;
    }
    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getPasswordConfirm()
    {
        return $this->passwordConfirm;
    }
    public function setPasswordConfirm($passwordConfirm) {
        $this->passwordConfirm = $passwordConfirm;
    }

    public function getPasswordUpdatedAt()
    {
        return $this->passwordUpdatedAt;
    }
    public function setPasswordUpdatedAt($passwordUpdatedAt = null)
    {
        $this->passwordUpdatedAt = $passwordUpdatedAt == null ? new \DateTime() : $passwordUpdatedAt;
    }

    public function getLastName()
    {
        return $this->lastName;
    }
    public function setLastName($lastName) {
        $this->lastName = $lastName;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    public function getRemarks()
    {
        return $this->remarks;
    }
    public function setRemarks($remarks)
    {
        $this->remarks = $remarks;
    }

    public function getIsActive()
    {
        return $this->isActive;
    }
    public function setIsActive($isActive) {
        $this->isActive = $isActive;
    }

    public function getIsLocked() {
        return $this->isLocked;
    }
    public function setIsLocked($isLocked) {
        $this->isLocked = $isLocked;
    }

    public function getAuthenticationFailureCount() {
        return $this->authentication_failure_count;
    }
    public function setAuthenticationFailureCount($authenticationFailureCount) {
        $this->authentication_failure_count = $authenticationFailureCount;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }
    public function setCreatedAt($createdAt) {
        $this->createdAt = $createdAt;
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
        return$this->updatedManagerId;
    }
    public function setUpdatedManagerId($updatedManagerId) {
        $this->updatedManagerId = $updatedManagerId;
    }
}