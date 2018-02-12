<?php
/**
 * Description of Book
 *
 * @author Gisela Kurniawati
 */
class Income implements JsonSerializable {
    private $id;
    private $amount;
    private $description;
    private $date;

    private $category;
    private $user;
    
    function __construct() {
        $this->category = new IncomeCategory();
        $this->user = new User();
    }
    
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
    
        public function __set($name, $value) {
        if (!isset($this->category)) {
            $this->category = new Category();
        }
        if (isset($value)) {
            switch ($name) {
                case 'id':
                    $this->category->setId($value);
                    break;
                case 'name':
                    $this->category->setName($value);
                    break;
                case 'id':
                    $this->user->setId($value);
                    break;
                case 'name':
                    $this->user->setFullname($value);
                    break;
                default:
                    break;
            }
        }
    }

    public function jsonSerialize() {
        return get_object_vars($this);
    }
}
    