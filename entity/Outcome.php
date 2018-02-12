<?php
/**
 * Description of Book
 *
 * @author Gisela Kurniawati
 */
class Outcome implements JsonSerializable {
    private $id;
    private $amount;
    private $description;
    private $date;

    private $category;
    private $user;
    
    function getId() {
        return $this->id;
    }

    function getAmount() {
        return $this->amount;
    }

    function getDescription() {
        return $this->description;
    }

    function getDate() {
        return $this->date;
    }

    function getCategory() {
        return $this->category;
    }

    function getUser() {
        return $this->user;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setAmount($amount) {
        $this->amount = $amount;
    }

    function setDescription($description) {
        $this->description = $description;
    }

    function setDate($date) {
        $this->date = $date;
    }

    function setCategory($category) {
        $this->category = $category;
    }

    function setUser($user) {
        $this->user = $user;
    }

    public function jsonSerialize() {
        return get_object_vars($this);
    }
}
    