<?php
/**
 * Description of Book
 *
 * @author Gisela Kurniawati
 */
class User implements JsonSerializable {
    private $id;
    private $fullname;
    private $email;
    private $password;
     
    function getId() {
        return $this->id;
    }

    function getFullname() {
        return $this->fullname;
    }

    function getEmail() {
        return $this->email;
    }

    function getPassword() {
        return $this->password;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setFullname($fullname) {
        $this->fullname = $fullname;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setPassword($password) {
        $this->password = $password;
    }

    public function jsonSerialize() {
        return get_object_vars($this);
    }

}