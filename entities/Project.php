<?php

class Project implements JsonSerializable 
{
    // Properties
    private $id;
    private $name;
    private $code;
    private $date_start;
    private $date_end;


    // Constructor
    public function __construct($id, $name, $code, $date_start, $date_end) {
        $this->setId($id);
        $this->setName($name);
        $this->setCode($code);
        $this->setDate_start($date_start);
        $this->setDate_end($date_end);
    }


    // Getters y Setters
    // getters
    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getCode() {
        return $this->code;
    }

    public function getDate_start() {
        return $this->date_start;
    }

    public function getDate_end() {
        return $this->date_end;
    }

    // setters
    private function setId($id) {
        $this->id = $id;
    }

    private function setName($name) {
        $this->name = $name;
    }

    private function setCode($code) {
        $this->code = $code;
    }

    private function setDate_start($date_start) {
        $this->date_start = $date_start;
    }

    private function setDate_end($date_end) {
        $this->date_end = $date_end;
    }


    // Methods
    public function __toString() {
        return sprintf(
            "Project - ID: %d, Name: %s, Code: %s, Start Date: %s, End Date: %s",
            $this->getId(),
            $this->getName(),
            $this->getCode(),
            $this->getDate_start(),
            $this->getDate_end()
        );
    }
    
    public function jsonSerialize() {
        return get_object_vars($this);
    }
}