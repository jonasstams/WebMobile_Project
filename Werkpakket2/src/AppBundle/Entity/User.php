<?php

namespace AppBundle\Entity;

use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table("users")
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\UserRepository")
 */
class User implements UserInterface, \Serializable {

    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="username", type="string", length=255)
     */
    private $username;

    /**
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(name="rolesString", type="string", length=255)
     */
    private $rolesString;

    //methodes uit UserInterface

    public function getUserName() {
        return $this->username;
    }

    public function getPassword() {
        return $this->password;
    }

    public function eraseCredentials() {

    }

    public function getRoles() {
        return preg_split("/[\s,]+/", $this->rolesString);
    }

    public function getSalt() {
        return null;
    }

//methodes uit Serializable

    public function serialize() {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
            $this->rolesString
        ));
    }

    public function unserialize($serialized) {
        list (
            $this->id,
            $this->username,
            $this->password,
            $this->rolesString
            ) = unserialize($serialized);
    }

    //overblijvende getters /setters
    public function getId() {
        return $this->id;
    }

    public function setUserName($userName) {
        $this->username = $userName;

        return $this;
    }

    public function setPassword($password) {
        $this->password = password_hash($password, PASSWORD_BCRYPT) ;

        return $this;
    }

    public function setRolesString($rolesString) {
        $this->rolesString = $rolesString;

        return $this;
    }

    public function getRolesString() {
        return $this->rolesString;
    }

    //toString
    public function __toString() {
        return "Entity User, username= " . $this->username;
    }

}
