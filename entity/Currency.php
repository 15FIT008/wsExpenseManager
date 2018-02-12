<?php
/**
 * Description of Book
 *
 * @author Gisela Kurniawati
 */
class Currency implements JsonSerializable {
    private $id;
    private $name;
    private $code;

    function getId() {
        return $this->id;
    }

    function getName() {
        return $this->name;
    }

    function getCode() {
        return $this->code;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setCode($code) {
        $this->code = $code;
    }
    
    public function jsonSerialize() {
        return get_object_vars($this);
    }
}
    