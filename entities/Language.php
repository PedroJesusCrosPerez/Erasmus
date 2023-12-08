<?php
class Language implements JsonSerializable 
{
    // Properties
    private $id;

    // Constructor
    public function __construct($id) {
        $this->setId($id);
    }

    // Getters public
    public function getId() {
        return $this->id;
    }

    // Setters private
    private function setId($id) {
        $this->id = $id;
    }

    // Methods
    public function __toString() {
        return sprintf(
            "Language ID: %s | ",
            $this->getId()
        );
    }

    public function jsonSerialize() {
        return get_object_vars($this);
    }
}
?>