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

    public function setId($id)
    {
        $this->id = $id;
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

    /**
     * DB更新時に必要なプロパティに値をセット
     *
     * @param string  $type    INSERT or UPDATE
     * @param Manager $manager Managerオブジェクト
     */
    public function setProperties($type)
    {
        switch ($type) {
            case 'INSERT':
                if (count($_POST)) {
                    $this->setUsername(htmlentities($_POST['user_name'], ENT_QUOTES, 'UTF-8'));
                    $this->setPassword(htmlentities($_POST['password'], ENT_QUOTES, 'UTF-8'));
                    if (array_key_exists('password_confirm', $_POST)) {
                        $this->setPasswordConfirm((htmlentities($_POST['password_confirm'], ENT_QUOTES, 'UTF-8')));
                    }
                    $this->setLastName(htmlentities($_POST['last_name'], ENT_QUOTES, 'UTF-8'));
                    $this->setFirstName(htmlentities($_POST['first_name'], ENT_QUOTES, 'UTF-8'));
                    $this->setRemarks(htmlentities($_POST['remarks'], ENT_QUOTES, 'UTF-8'));

                    $date = new \DateTime();
                    $this->setCreatedAt($date->format('Y-m-d H:i:s'));
                }
                break;

            case 'UPDATE':
                if (count($_POST)) {
                    $this->setId(htmlentities($_POST['id'], ENT_QUOTES, 'UTF-8'));
                    $this->setUsername(htmlentities($_POST['user_name'], ENT_QUOTES, 'UTF-8'));
                    $this->setPassword(htmlentities($_POST['password'], ENT_QUOTES, 'UTF-8'));
                    if (array_key_exists('password_confirm', $_POST)) {
                        $this->setPasswordConfirm((htmlentities($_POST['password_confirm'], ENT_QUOTES, 'UTF-8')));
                    }
                    $this->setLastName(htmlentities($_POST['last_name'], ENT_QUOTES, 'UTF-8'));
                    $this->setFirstName(htmlentities($_POST['first_name'], ENT_QUOTES, 'UTF-8'));
                    $this->setRemarks(htmlentities($_POST['remarks'], ENT_QUOTES, 'UTF-8'));

                    $date = new \DateTime();
                    $this->setUpdatedAt($date->format('Y-m-d H:i:s'));
                    // TODO: セッション実装後に以下設定
//                        $this->setUpdatedManagerId('...');
                    $this->setPasswordUpdatedAt($date->format('Y-m-d H:i:s'));
                }
                break;
        }
    }

    public function getProperties()
    {
        return $manager = [
            'id' => $this->getId(),
            'username'                   => $this->getUsername(),
            'password'                   => $this->getPassword(),
            'passwordConfirm'            => $this->getPasswordConfirm(),
            'passwordUpdatedAt'          => $this->getPasswordUpdatedAt(),
            'lastName'                   => $this->getLastName(),
            'firstName'                  => $this->getFirstName(),
            'remarks'                    => $this->getRemarks(),
            'isActive'                   => $this->getIsActive(),
            'isLocked'                   => $this->getIsLocked(),
            'authenticationFailureCount' => $this->getAuthenticationFailureCount(),
            'createdAt'                  => $this->getCreatedAt(),
            'updatedAt'                  => $this->getUpdatedAt(),
            'updatedManagerId'           => $this->getUpdatedManagerId()
        ];
    }
}