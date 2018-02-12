<?php
/**
 * Description of Book
 *
 * @author Gisela Kurniawati
 */
class IncomeCategory implements JsonSerializable {
    private $id;
    private $category;
    
    function getId() {
        return $this->id;
    }

    function getCategory() {
        return $this->category;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setCategory($category) {
        $this->category = $category;
    }

    public function jsonSerialize() {
        return get_object_vars($this);
    }
}
    