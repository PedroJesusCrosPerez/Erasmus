<?php
class Item_baremable implements JsonSerializable 
{
    // Properties
    private $id;
    private $name;

    // Constructor
    public function __construct($id, $name) {
        $this->setId($id);
        $this->setName($name);
    }

    // Getters public
    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    // Setters private
    private function setId($id) {
        $this->id = $id;
    }

    private function setName($name) {
        $this->name = $name;
    }

    // Methods
    public function __toString() {
        return sprintf(
            "Class ID: %s, Name: %s",
            $this->getId(),
            $this->getName()
        );
    }

    public function jsonSerialize() {
        return get_object_vars($this);
    }
}
?>