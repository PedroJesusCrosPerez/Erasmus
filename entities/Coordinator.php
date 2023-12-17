<?php
class Group implements JsonSerializable 
{
    // Properties
    private $id;
    private $name;
    private $password;

    // Constructor
    public function __construct($id, $name, $password) {
        $this->setId($id);
        $this->setName($name);
        $this->setPassword($password);
    }

    // Getters public
    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getPassword() {
        return $this->password;
    }

    // Setters private
    private function setId($id) {
        $this->id = $id;
    }

    private function setName($name) {
        $this->name = $name;
    }

    private function setPassword($password) {
        $this->password = $password;
    }

    // Methods
    public function __toString() {
        return sprintf(
            "Group ID: %s, Name: %s, Password: %s",
            $this->getId(),
            $this->getName(),
            $this->getPassword()
        );
    }

    public function jsonSerialize() {
        return get_object_vars($this);
    }
}
?>